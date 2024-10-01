<template>
    <BaseCard :is-loading="isLoading">
        <div class="flex justify-center items-center">
            <BaseButton as="label">
                <i class="fas fa-upload mr-2"></i> {{$trans('global.upload', {attribute: $trans('general.file')}) }}
                <input type="file" @change="isFileSelected" :name="state.uniqueId" :id="state.uniqueId" class="hidden">
            </BaseButton>
        </div>

        <template #footer>
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <BaseCheckbox v-model="state.validate" name="validate" :label="$trans('global.validate', {attribute: $trans('general.file')})"></BaseCheckbox>
                    <slot name="option"></slot>
                </div>

                <div class="space-x-4">
                    <BaseButton design="error" @click="$emit('cancelled')">
                        {{$trans("general.cancel")}}
                    </BaseButton>
                    <BaseButton design="primary" v-if="state.isFileSelected" @click="upload">
                        {{$trans("general.import")}}
                    </BaseButton>
                </div>
            </div>
        </template>
    </BaseCard>

    <BaseModal :show="showModal" @close="showModal = false">
        <template #title><i class="fas fa-times-circle"></i> {{$trans('general.import_error', {attribute: state.errorCount})}}</template>

        <div class="max-h-96 scroller-thin-y">
            <BaseTable>
                <template #header>
                    <BaseHeader v-for="header in state.errorHeader">
                        {{header}}
                    </BaseHeader>
                </template>

                <DataRow no-responsive v-for="items in state.errorItems">
                    <DataCell no-responsive v-for="item in items" name="">
                        {{ item }}
                    </DataCell>
                </DataRow>
            </BaseTable>
        </div>

        <div class="mt-4 flex">
            <BaseButton type="primary" @click="showModal = false">{{$trans('general.ok')}}</BaseButton>
        </div>
    </BaseModal>
</template>

<script>
export default {
    name: 'BaseImport'
}
</script>

<script setup>
import { ref, reactive, computed, onMounted, inject } from "vue"
import { useStore } from "vuex"
import { useToast } from 'vue-toastification'

const store = useStore()
const toast = useToast()

const $trans = inject('$trans')

const emit = defineEmits(['cancelled', 'hide', 'completed'])

const props = defineProps({
    path: {
        type: String,
        default: ''
    },
    option: {
        type: Object,
        default() {
            return {}
        }
    }
})

const postMaxSize = computed(() => store.getters['config/config']('system.postMaxSize'))

const state = reactive({
    validate: false,
    uniqueId: '',
    isFileSelected: false,
    errorCount: 0,
    errorHeader: [],
    errorItems: []
})

const showModal = ref(false)
const file = ref(null)
const selectedFile = ref(null)
const isLoading = ref(null);

const isFileSelected = (e) => {
    let files = e.target.files || e.dataTransfer.files;
    let allowedExtensions = /(\.xls|\.xlsx)$/i;
    if(! allowedExtensions.exec(files[0].name)) {
        toast.error($trans('general.errors.file_not_supported'))
        return;
    }

    if (! files.length) {
        return;
    }

    file.value = e
    selectedFile.value = files
    state.isFileSelected = true
}

const reset = () => {
    file.value.target.value = null
    selectedFile.value = null
    state.isFileSelected = false
}

const upload = async () => {
    if (selectedFile.value[0] > postMaxSize.value) {
        toast.error($trans('general.errors.file_too_large'))
        return;
    }

    isLoading.value = true

    let formData = new FormData();
    formData.append('file', selectedFile.value[0]);
    formData.append('validate', state.validate);
    for (const [key, value] of Object.entries(props.option)) {
        formData.append(key, value);
    }

    await store.dispatch('moduleImport/upload', {
        path: props.path,
        data: formData
    }).then(response => {
        isLoading.value = false
        reset()
        if (response.imported) {
            emit('hide')
            emit('completed')
        }
    }).catch(error => {
        isLoading.value = false
        if (error.showLog) {
            showModal.value = true
            state.errorCount = error.count
            state.errorHeader = error.items.shift()
            state.errorItems = error.items
        }
        reset()
    })
}

onMounted(() => {
    state.uniqueId = Math.random()
        .toString(16)
        .slice(2)
})
</script>
