<template>
    <BaseLoader :is-loading="isLoading">
        <template v-if="design == 'traditional'">
            <div class="flex justify-center border border-gray-100 dark:border-gray-700 rounded-lg h-64 w-full p-4" :class="{
                'bg-gray-800': dark
            }">
                <template v-if="state.source || src">
                    <img :src="state.source || src" class="object-scale-down" />
                </template>
            </div>

            <div class="flex justify-center space-x-4" v-show="! disabled && ! state.source">
                <BaseButton as="label">
                    <i class="fas fa-upload mr-2"></i> {{src ? $trans('global.change', {attribute: label}) : $trans('general.upload') }}
                    <input ref="file" type="file" @change="previewImage" :name="state.uniqueId" :id="state.uniqueId" class="hidden">
                </BaseButton>
                <BaseButton design="danger" v-if="src" @click="remove">{{$trans('general.remove')}}</BaseButton>
            </div>
            <div class="flex justify-center space-x-4" v-if="state.source">
                <BaseButton @click="upload">{{$trans('global.upload', {attribute: label})}}</BaseButton>
                <BaseButton design="danger" @click="cancelUpload">{{$trans('general.cancel')}}</BaseButton>
            </div>
        </template>

        <template v-if="design == 'modern'">
            <ImageLabel v-if="showLabel" :label="label" :size="recommendedSize" />
            <div class="relative group w-full flex justify-center items-center border border-gray-200 dark:border-gray-700" :class="{
                    'aspect-square': shape == 'circle',
                    'aspect-video': shape == 'rectangle',
                    'h-full': objectFit == true || shape == 'circle',
                    'h-64 px-2 py-4': objectFit == false && shape != 'circle',
                    'rounded-xl': objectFit == false,
                    'rounded-full': shape == 'circle',
                    'bg-gray-800': dark,
                }">
                <!-- <div v-if="showLabel && shape != 'circle'" class="absolute z-10 text-sm" :class="{
                    'inset-0 h-full w-full flex justify-center items-center': shape == 'circle',
                    'bottom-2 right-3': shape == 'rectangle',
                    'text-gray-300': dark,
                    'text-gray-700 dark:text-gray-400': ! dark,
                }">
                    {{label}}
                </div> -->
                <div class="absolute z-10 opacity-0 group-hover:opacity-100" :class="{
                    'inset-0 h-full w-full flex justify-center items-center': shape == 'circle',
                    'top-2 right-3': shape == 'rectangle',
                }">
                    <div v-show="! disabled && ! state.source" class="flex space-x-2">
                        <label class="cursor-pointer h-8 w-8 flex justify-center items-center rounded-full bg-gray-800 opacity-50 border border-gray-200" v-tooltip="src ? $trans('global.change', {attribute: label}) : $trans('general.upload')">
                            <input ref="file" type="file" @change="previewImage" :name="state.uniqueId" :id="state.uniqueId" class="hidden">
                            <i class="fas fa-edit text-gray-200"></i>
                        </label>
                        <div class="h-8 w-8 flex justify-center items-center rounded-full bg-gray-800 opacity-50 border border-gray-200 cursor-pointer" @click="remove" v-tooltip="$trans('general.remove')">
                            <i v-if="src" class="fas fa-times text-gray-200"></i>
                        </div>
                    </div>
                    <div v-if="state.source" class="flex space-x-2">
                        <div class="h-8 w-8 flex justify-center items-center rounded-full bg-gray-800 opacity-50 border border-gray-200 cursor-pointer" @click="upload" v-tooltip="$trans('global.save', {attribute: label})">
                            <i class="fas fa-save text-gray-200"></i>
                        </div>
                        <div class="h-8 w-8 flex justify-center items-center rounded-full bg-gray-800 opacity-50 border border-gray-200 cursor-pointer" @click="cancel" v-tooltip="$trans('general.cancel')">
                            <i class="fas fa-times text-gray-200"></i>
                        </div>
                    </div>
                </div>
                <img :src="state.source || src" class="object-cover max-h-full" :class="$attrs.class" />
            </div>
        </template>
    </BaseLoader>
</template>

<script>
export default {
    name: 'ImageUpload'
}
</script>

<script setup>
import { reactive, ref, onMounted, inject, computed } from "vue"
import { useStore } from "vuex"
import { useToast } from 'vue-toastification'

const store = useStore()
const toast = useToast()

const $trans = inject('$trans')

const emit = defineEmits(['uploaded', 'removed'])

const props = defineProps({
    design: {
        type: String,
        default: 'traditional'
    },
    shape: {
        type: String,
        default: 'rectangle',
    },
    objectFit: {
        type: Boolean,
        default: true
    },
    label: {
        type: String,
        default: 'Image'
    },
    showLabel: {
        type: Boolean,
        default: false,
    },
    src: {
        type: String,
        default: '',
    },
    dark: {
        type: Boolean,
        default: false
    },
    uploadPath: {
        type: String,
        required: true
    },
    removePath: {
        type: String,
        default: ''
    },
    disabled: {
        type: Boolean,
        default: false
    },
    recommendedSize: {
        type: String,
        default: '',
    }
})

const postMaxSize = computed(() => store.getters['config/config']('system.postMaxSize'))

const state = reactive({
    source: null,
    uniqueId: ''
})

const file = ref([])
const isLoading = ref(false);
const showActions = ref(false);

const previewImage = (e) => {
    let files = e.target.files || e.dataTransfer.files;
    let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(! allowedExtensions.exec(files[0].name)) {
        toast.error($trans('general.errors.file_not_supported'))
        return;
    }

    if (! files.length) {
        return;
    }

    createImage(files[0]);
}

const createImage = (file) => {
    let reader = new FileReader();
    reader.onload = (e) => {
        state.source = e.target.result;
    };
    reader.readAsDataURL(file);
}

const cancelUpload = () => {
    file.value = []
    state.source = null
}

const upload = async () => {
    if (file.value.files[0].size > postMaxSize.value) {
        toast.error($trans('general.errors.file_too_large'))
        return;
    }

    isLoading.value = true

    let formData = new FormData();
    formData.append('image', file.value.files[0]);

    await store.dispatch('image/upload', {
        path: props.uploadPath,
        data: formData
    }).then(response => {
        isLoading.value = false
        emit('uploaded')
    }).catch(e => {
        isLoading.value = false
    })
}

const remove = async () => {
    isLoading.value = true

    await store.dispatch('image/remove', {
        path: props.removePath
    }).then(response => {
        isLoading.value = false
        emit('removed')
    }).catch(e => {
        isLoading.value = false
    })
}

onMounted(() => {
    state.uniqueId = props.id || Math.random()
        .toString(16)
        .slice(2)
})
</script>
