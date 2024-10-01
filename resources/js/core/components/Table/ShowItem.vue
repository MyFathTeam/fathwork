<template>
    <BaseLoader :is-loading="isLoading">
        <div class="space-y-4">
            <slot></slot>
        </div>
    </BaseLoader>
</template>

<script>
export default {
    name: "ShowItem"
}
</script>

<script setup>
import { onMounted, onBeforeUnmount, inject, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useStore } from "vuex";
import { confirmAction, confirmDelete } from "@core/helpers/alert";

const route = useRoute();
const router = useRouter();
const store = useStore();

const emitter = inject("emitter");

const emit = defineEmits([
    "setItem",
    "redirectTo",
    "refreshed"
]);

const props = defineProps({
    initUrl: {
        type: String,
        default: "",
        required: true,
    },
    uuid: {
        type: String,
        default: "",
        required: true
    },
    moduleUuid: {
        type: String,
        default: ""
    },
    redirect: {
        type: [String, Object],
        default: "",
    },
    refresh: {
        type: Boolean,
        default: false
    }
});

const isLoading = ref(false);

const getItem = async () => {
    isLoading.value = true
    await store
        .dispatch(props.initUrl + "get", {
            uuid: props.uuid,
            moduleUuid: props.moduleUuid,
        })
        .then((response) => {
            isLoading.value = false
            emit("setItem", response);
        })
        .catch((e) => {
            isLoading.value = false
            redirect()
        });
};

const deleteItem = async (payload) => {
    if (! await confirmDelete()) {
        return;
    }

    isLoading.value = true
    await store
        .dispatch(props.initUrl + "delete", {
            uuid: payload.uuid,
        })
        .then(() => {
        isLoading.value = false
            redirect()
        })
        .catch((e) => {
        isLoading.value = false
        });
};

const actionItem = async (payload) => {
    isLoading.value = true
    await store
        .dispatch(props.initUrl + payload.action, {
            uuid: payload.uuid,
            moduleUuid: payload.moduleUuid,
            data: payload.data
        })
        .then(() => {
            isLoading.value = false
            getItem();
            emitter.emit('showActionPerformed')
        })
        .catch((e) => {
            isLoading.value = false
        });
};

const redirect = () => {
    if (props.redirect && typeof props.redirect === 'string') {
        router.push({name: props.redirect})
    } else if (props.redirect && typeof props.redirect === 'object') {
        router.push(props.redirect)
    } else {
        emit("redirectTo");
    }
}

watch(
    () => props.refresh,
    (value) => {
        if (value) {
            getItem();
            emit('refreshed')
        }
    }
)

onMounted(async () => {
    emitter.on("showDeleteItem", (payload) => {
        deleteItem(payload);
    });

    emitter.on("showActionItem", async (payload) => {
        if (payload.confirmation) {
            if (await confirmAction()) {
                actionItem(payload)
            }
        } else {
            actionItem(payload)
        }
    });

    emitter.on("refreshItem", (payload) => {
        getItem();
    });

    getItem();
});

onBeforeUnmount(() => {
    emitter.all.delete("showDeleteItem")
    emitter.all.delete("showActionItem")
    emitter.all.delete("refreshItem")
})
</script>
