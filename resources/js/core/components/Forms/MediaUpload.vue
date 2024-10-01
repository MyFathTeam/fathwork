<template>
    <div class="mt-4 space-y-4">
        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 space-y-2" v-if="state.media.length > 0">
            <template v-for="(mediaFile, index) in state.media">
                <div class="flex justify-between text-gray-800 dark:text-gray-400 text-sm">
                    <div>
                        <span class="mr-2">
                            <span v-if="mediaFile.status == 'waiting'" v-tooltip="$trans('global.uploading', {attribute: mediaFile.progress + '%' })"><i class="fas fa-upload"></i></span>
                            <span v-if="mediaFile.status == 'uploaded'"><i class="fas fa-check-circle text-success"></i></span>
                            <span v-if="mediaFile.status == 'error'" v-tooltip="mediaFile.msg"><i class="fas fa-exclamation-circle text-danger"></i></span>
                        </span>
                        <span>{{mediaFile.file.name}}</span>
                    </div>
                    <div class="space-x-4">
                        <span>{{mediaFile.size}} <i class="fas" :class="mediaFile.icon"></i> </span>
                        <span class="cursor-pointer" v-if="mediaFile.status == 'waiting'" @click="mediaFile.cancel" v-tooltip="$trans('general.cancel')"><i class="fas fa-times text-danger"></i> </span>
                        <span class="cursor-pointer" v-else @click="remove(mediaFile, index)" v-tooltip="$trans('global.delete', {attribute: $trans('general.file')})"><i class="fas fa-times-circle text-danger"></i> </span>
                    </div>
                </div>
                <div class="w-full bg-gray-200 h-1" v-if="mediaFile.status == 'waiting'">
                    <div class="h-1" :class="{
                        'bg-info': mediaFile.progress < 100,
                        'bg-success': mediaFile.progress == 100
                    }" :style="{width: mediaFile.progress + '%'}"></div>
                </div>
            </template>
        </div>

        <div class="flex" v-show="! disabled">
            <BaseButton as="label">
                <i class="fas fa-upload mr-2"></i> {{label ? $trans('global.upload', {attribute: label}) : $trans('general.upload') }}
                <input ref="file" type="file" @input="prepareFileLists" :key="state.token" :multiple="multiple" :name="state.uniqueId" :id="state.uniqueId" class="hidden">
            </BaseButton>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MediaUpload'
}
</script>

<script setup>
import { reactive, ref, inject, computed, onMounted, onBeforeUnmount, watch } from "vue"
import { useStore } from "vuex"
import { useToast } from 'vue-toastification'
import axios from 'axios'
import { v4 as uuidv4 } from 'uuid';
import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { random } from "@core/helpers/string"
import { confirmAction } from "@core/helpers/alert";

const store = useStore()
const toast = useToast()

const $trans = inject('$trans')
const emitter = inject("emitter");

const emit = defineEmits(['setToken', 'setHash', 'uploaded'])

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    module: {
        type: String,
        required: true
    },
    multiple: {
        type: Boolean,
        default: false
    },
    media: {
        type: Array,
        default: []
    },
    disabled: {
        type: Boolean,
        default: false
    },
    mediaToken: {
        type: String,
        default: ''
    }
})

const postMaxSize = computed(() => store.getters['config/config']('system.postMaxSize'))

const state = reactive({
    initURL: '/app/',
    token: '',
    hash: '',
    uniqueId: '',
    media: [],
    progress: 0
})

const file = ref(null)

const resetUpload = () => {
    file.value = null
}

const prepareFileLists = (event) => {
    if (typeof file.value?.files !== 'object') {
        toast.error($trans('general.errors.invalid_action'))
        return;
    }

    for (let i = 0; i < file.value.files.length; i++) {
        if (file.value.files[i].size > postMaxSize.value) {
            toast.error($trans('general.errors.file_too_large'))
        } else {
            state.media.push({
                uuid: null,
                file: file.value.files[i],
                status: 'waiting',
                msg: '',
                progress: 0
            })
        }
    }
    upload()
}

const upload = async () => {
    const CancelToken = axios.CancelToken
    state.media.forEach((media, index) => {

        if (media.status === 'waiting') {
            let formData = new FormData()
            formData.append('file', media.file)
            formData.append('module', props.module)
            formData.append('token', state.token)
            formData.append('hash', state.hash)

            Api.custom({
                url: state.initURL + 'medias',
                method: 'POST',
                data: formData,
                upload: true,
                onUploadProgress: progressEvent => {
                    media.progress = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                },
                cancelToken: new CancelToken(cancel => {
                    media.cancel = cancel;
                })
            })
            .then(response => {
                media.status = 'uploaded'
                media.uuid = response.uuid
                media.icon = response.icon
                media.size = response.size
            }).catch(error => {
                if (error === undefined) {
                    state.media.splice(index, 1)
                } else {
                    let msg = Form.getErrors(error)
                    media.status = 'error'
                    media.msg = msg.message
                }
            })
        }

    })
}

const remove = async (mediaFile, index) => {
    if (mediaFile.status === 'error' || ! mediaFile.uuid) {
        state.media.splice(index, 1)
        return;
    }

    if (! await confirmAction()) {
        return;
    }

    Api.custom({
        url: state.initURL + 'medias/' + mediaFile.uuid + '?hash=' + state.hash,
        method: 'DELETE',
    })
    .then(response => {
        state.media.splice(index, 1)
    })
    .catch(error => {})
}

watch(
    () => [state.token, state.hash, props.media],
    (value) => {
        if (value[0]) {
            emit('setToken', state.token)
        }

        if (value[1]) {
            emit('setHash', state.hash)
        }

        if (value[2].length) {
            state.media = value[2]
        }

    }
)

onMounted(() => {
    state.token = props.mediaToken || uuidv4()
    state.hash = random(8)
    emitter.on("resetFiles", () => {
        file.value = null
        state.media = []
        state.token = uuidv4()
        state.hash = random(8)
    });

    emitter.on("setMediaToken", (token) => {
        state.token = token
    });

    state.uniqueId = props.id || Math.random()
        .toString(16)
        .slice(2)
})

onBeforeUnmount(() => {
    emitter.all.delete("resetFiles")
    emitter.all.delete("setMediaToken")
})
</script>
