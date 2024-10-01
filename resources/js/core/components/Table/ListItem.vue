<template>
    <div :class="{
        'space-y-4' : spacing
    }">
        <div>
            <slot name="header"></slot>
        </div>
        <div>
            <slot name="after-header"></slot>
        </div>
        <div>
            <slot name="import"></slot>
        </div>
        <div>
            <slot name="before-filter"></slot>
        </div>
        <div>
            <slot name="filter"></slot>
        </div>
        <div>
            <slot name="after-filter"></slot>
        </div>

        <BaseLoader :is-loading="isLoading">
            <slot></slot>
        </BaseLoader>
    </div>
</template>

<script>
export default {
    name: "ListItem",
};
</script>

<script setup>
import { onMounted, onBeforeUnmount, inject, ref } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import { confirmAction, confirmDelete } from "@core/helpers/alert";

const route = useRoute();
const store = useStore();

const emitter = inject("emitter");

const emit = defineEmits(["setPreRequisites", "setItems", "resetSelected"]);

const props = defineProps({
    initUrl: {
        type: String,
        default: "",
        required: true,
    },
    uuid: {
        type: String,
        default: "",
    },
    preRequisites: {
        type: [Boolean, String],
        default: false,
    },
    spacing: {
        type: Boolean,
        default: true
    }
});

const isLoading = ref(false);

const getPreRequisites = () => {
    isLoading.value = true
    store
        .dispatch(props.initUrl + "preRequisite", {})
        .then((response) => {
            isLoading.value = false
            emit("setPreRequisites", response);
            listItems()
        })
        .catch((e) => {
            isLoading.value = false
        });
};

const listItems = () => {
    isLoading.value = true
    store
        .dispatch(props.initUrl + "list", {
            uuid: props.uuid,
            params: route.query,
            queryType: route.meta.queryType
        })
        .then((response) => {
            isLoading.value = false
            emit("setItems", response);
        })
        .catch((e) => {
            isLoading.value = false
        });
};

const deleteItem = async (payload) => {
    if (! await confirmDelete()) {
        return;
    }

    isLoading.value = true
    await store
        .dispatch(props.initUrl + "delete", {
            uuid: props.uuid || payload.uuid,
            moduleUuid: payload.moduleUuid,
            queryType: route.meta.queryType
        })
        .then(() => {
            isLoading.value = false
            listItems();
        })
        .catch((e) => {
            isLoading.value = false
        });
};

const deleteItems = async (payload) => {
    if (! await confirmDelete()) {
        return;
    }

    isLoading.value = true
    await store
        .dispatch(props.initUrl + "deleteItems", {
            moduleUuid: props.moduleUuid,
            global: payload.global,
            uuids: payload.uuids,
            params: route.query,
            queryType: route.meta.queryType
        })
        .then(() => {
            isLoading.value = false
            emit('resetSelected')
            listItems();
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
        })
        .then(() => {
            isLoading.value = false
            listItems();
            emitter.emit('actionPerformed')
        })
        .catch((e) => {
            isLoading.value = false
        });
};

const actionItems = async (payload) => {
    isLoading.value = true
    await store
        .dispatch(props.initUrl + payload.action, {
            moduleUuid: props.moduleUuid,
            global: payload.global,
            uuids: payload.uuids,
            params: route.query,
            queryType: route.meta.queryType
        })
        .then(() => {
            isLoading.value = false
            listItems();
            emitter.emit('actionPerformed')
        })
        .catch((e) => {
            isLoading.value = false
        });
};

onMounted(async () => {
    emitter.on("listItems", () => {
        listItems();
    });

    emitter.on("deleteItem", (payload) => {
        deleteItem(payload);
    });

    emitter.on("deleteItems", (payload) => {
        deleteItems(payload);
    });

    emitter.on("actionItem", async (payload) => {
        if (payload.confirmation) {
            if (await confirmAction()) {
                actionItem(payload)
            }
        } else {
            actionItem(payload)
        }
    });

    emitter.on("actionItems", async (payload) => {
        if (payload.confirmation) {
            if (await confirmAction()) {
                actionItems(payload)
            }
        } else {
            actionItems(payload)
        }
    });

    if (props.preRequisites) {
        getPreRequisites();
    } else {
        listItems();
    }
});

onBeforeUnmount(() => {
    emitter.all.delete("listItems")
    emitter.all.delete("deleteItem")
    emitter.all.delete("deleteItems")
    emitter.all.delete("actionItem")
})
</script>
