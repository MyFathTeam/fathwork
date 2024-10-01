<template>
    <form @submit.prevent="submit">
        <BaseLoader :is-loading="isLoading">
            <template v-if="noCard">
                <slot></slot>
                <FormActionButton class="mt-6" v-if="! noActionButton" :cancel-action="cancelAction" :redirect="redirect" :keep-adding="shouldKeepAdding" :button-padding="buttonPadding" @cancelled="emit('cancelled')" />
            </template>
            <template v-else>
                <BaseCard :less-padding="lessPadding">
                    <slot></slot>
                    <template #footer>
                        <FormActionButton :disabled="disabled" :submit-text="submitText" v-if="! noActionButton" :cancel-action="cancelAction" :redirect="redirect" :keep-adding="shouldKeepAdding" :button-padding="buttonPadding" @cancelled="emit('cancelled')" />
                    </template>
                </BaseCard>
            </template>
        </BaseLoader>
    </form>
</template>

<script>
export default {
    name: "FormAction",
};
</script>

<script setup>
import { inject, computed, onMounted, onBeforeUnmount, reactive, ref } from "vue";
import { useRoute, useRouter, onBeforeRouteLeave } from "vue-router";
import { useStore } from "vuex";
import { useToast } from 'vue-toastification'
import { cloneDeep } from "@core/utils"
import { confirmAction } from "@core/helpers/alert";

const route = useRoute();
const router = useRouter();
const store = useStore();
const toast = useToast()

const emitter = inject("emitter");
const $trans = inject("$trans");

const emit = defineEmits([
    "setPreRequisites",
    "redirectTo",
    "resetForm",
    "completed",
    "end",
    "cancelled"
]);

const props = defineProps({
    noCard: {
        type: Boolean,
        default: false
    },
    initUrl: {
        type: String,
        default: "",
        required: true,
    },
    uuid: {
        type: String,
        default: ""
    },
    moduleUuid: {
        type: String,
        default: ""
    },
    preRequisites: {
        type: [Boolean, String, Object],
        default: false,
    },
    preRequisiteUrl: {
        type: String,
        default: "",
    },
    preRequisiteCustomUrl: {
        type: String,
        default: "",
    },
    noDataFetch: {
        type: Boolean,
        default: false
    },
    dataFetch: {
        type: String,
        default: "",
    },
    form: {
        type: Object,
        default() {
            return {};
        },
    },
    initForm: {
        type: Object,
        default() {
            return {};
        },
    },
    redirect: {
        type: [String, Object],
        default: "",
    },
    action: {
        type: String,
        default: "",
    },
    noActionButton: {
        type: Boolean,
        default: false,
    },
    resetForm: {
        type: Boolean,
        default: true
    },
    resetFormError: {
        type: Boolean,
        default: true
    },
    beforeSubmit: {
        type: Function,
        default() {
            return {}
        }
    },
    afterSubmit: {
        type: Function,
        default() {
            return {}
        }
    },
    afterReset: {
        type: Function,
        default() {
            return {}
        }
    },
    setForm: {
        type: Function,
        default() {
            return {}
        }
    },
    afterSet: {
        type: Function,
        default() {
            return {}
        }
    },
    stayOn: {
        type: Boolean,
        deafult: false
    },
    keepAdding: {
        type: Boolean,
        default: true
    },
    confirmation: {
        type: Boolean,
        default: false
    },
    isModal: {
        type: Boolean,
        default: false
    },
    disabled: {
        type: Boolean,
        default: false
    },
    submitText: {
        type: String,
        default: ''
    },
    lessPadding: {
        type: Boolean,
        default: false
    },
    buttonPadding: {
        type: Boolean,
        default: false
    },
    sideover: {
        type: Boolean,
        default: false
    },
    cancelAction: {
        type: Boolean,
        default: false
    }
});

const shouldKeepAdding = computed(() => {
    if (props.stayOn) {
        return false;
    }

    return props.keepAdding
})

const isLoading = ref(false);

const state = reactive({
    keepAdding: false
})

const getPreRequisites = async () => {
    isLoading.value = true

    let data = props.preRequisites
    if (typeof props.preRequisites === 'string') {
        data = {data: props.preRequisites}
    } else if (route.params.uuid) {
        data = {uuid: route.params.uuid}
    }

    await store
        .dispatch((props.preRequisiteUrl || props.initUrl) + (props.preRequisiteCustomUrl || "preRequisite"), data)
        .then((response) => {
            isLoading.value = false
            emit("setPreRequisites", response);
        })
        .catch((e) => {
            isLoading.value = false
        });
};

const fetchItem = async () => {
    isLoading.value = true
    await store
        .dispatch(props.initUrl + "fetch", {
            type: props.dataFetch,
        })
        .then((response) => {
            isLoading.value = false
            afterGetItem(response)
        })
        .catch((e) => {
            isLoading.value = false
            redirectTo()
        });
};

const getItem = async () => {
    isLoading.value = true
    await store
        .dispatch(props.initUrl + "get", {
            uuid: route.params.uuid,
            moduleUuid: props.moduleUuid,
            queryType: route.meta.queryType
        })
        .then((response) => {
            isLoading.value = false
            afterGetItem(response)
        })
        .catch((e) => {
            isLoading.value = false
            redirectTo()
        });
};

const submit = async () => {
    let keysToOmit = ['mediaHash', 'mediaToken']
    if (_.isEqual(_.omit(props.form, keysToOmit), _.omit(props.initForm, keysToOmit))) {
        toast.info($trans('general.infos.nothing_to_submit'))
        return;
    }

    if (props.confirmation) {
        if (! await confirmAction()) {
            return;
        }
    }

    if (asFunction(props.beforeSubmit)) {
        props.beforeSubmit()
    }

    let action = props.initUrl + (props.action || route.meta.action);
    isLoading.value = true
    await store
        .dispatch(action, {
            form: props.form,
            moduleUuid: props.moduleUuid,
            uuid: props.uuid || route.params.uuid,
            queryType: route.meta.queryType,
            routeQuery: route.query
        })
        .then((response) => {
            isLoading.value = false

            if (! props.isModal) {
                if (! props.stayOn) {
                    Object.assign(props.form, cloneDeep(props.initForm))
                } else {
                    Object.assign(props.initForm, cloneDeep(props.form))
                }
            }

            if (! props.stayOn || props.keepAdding) {
                emitter.emit('resetFiles')
            }

            if (asFunction(props.afterSubmit)) {
                props.afterSubmit(response)
                return;
            }

            if (! props.sideover && ! state.keepAdding && ! props.stayOn) {
                redirectTo()
            } else {
                emit('completed')

                if (props.sideover && ! state.keepAdding) {
                    emit('end')
                }
            }
        })
        .catch((e) => {
            isLoading.value = false
        });
};

const afterGetItem = (response) => {
    store.dispatch(props.initUrl + "resetFormErrors");

    if (asFunction(props.setForm)) {
        props.setForm(response)

        if (response?.hasOwnProperty('mediaToken')) {
            emitter.emit('setMediaToken', response.mediaToken)
        }
    } else {
        if (route.meta.type == 'duplicate') {
            response.media = []
        }

        Object.assign(props.initForm, cloneDeep(response));
        Object.assign(props.form, cloneDeep(response));

        if (props.form.hasOwnProperty('mediaToken')) {
            emitter.emit('setMediaToken', props.form.mediaToken)
        }

        if (asFunction(props.afterSet)) {
            props.afterSet(response)
        }
    }
}

const redirectTo = () => {
    if (props.redirect && typeof props.redirect === 'string') {
        router.push({name: props.redirect})
    } else if (props.redirect && typeof props.redirect === 'object') {
        router.push(props.redirect)
    } else {
        emit("redirectTo");
    }
}

const resetFormErrors = () => {
    if (props.resetFormError) {
        store.dispatch(props.initUrl + "resetFormErrors");
    }
}

onMounted(async () => {
    emitter.on("redirect", () => {
        redirectTo()
    });

    emitter.on("keepAdding", (value) => {
        state.keepAdding = value
    });

    emitter.on("resetForm", () => {
        Object.assign(props.form, cloneDeep(props.initForm))
        emitter.emit('resetFiles')
        resetFormErrors()

        if (asFunction(props.afterReset)) {
            props.afterReset()
        }
    });

    emitter.on("submitForm", () => {
        submit()
    });

    if (props.preRequisites) {
        await getPreRequisites();
    }

    if (! props.noDataFetch && route.params.uuid) {
        await getItem();
    }

    if (route.params.muuid) {
        await getItem();
    }

    if (props.dataFetch) {
        await fetchItem();
    }
});

const asFunction = (func) => {
    if (func.name !== '_default' && func.name !== 'default') {
        return true
    }
    return false
}

onBeforeRouteLeave((to, from) => {
    resetFormErrors()
});

onBeforeUnmount(() => {
    emitter.all.delete("redirect")
    emitter.all.delete("keepAdding")
    emitter.all.delete("resetForm")
    emitter.all.delete("submitForm")
})
</script>
