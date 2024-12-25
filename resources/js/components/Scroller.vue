<script setup>
import { RecycleScroller } from "vue-virtual-scroller";
import { ref } from "vue";
import Bitset from "bitset";

const props = defineProps({
    state: String,
    count: Number,
});

const bitset = new Bitset();

for (let i = 0; i < props.state.length; i++) {
    bitset.set(i, Number(props.state.charAt(i)));
}

let items = [...Array(1000000).keys()].map((index) => {
    return {
        id: index + 1,
        checked: bitset.get(index + 1),
    };
});

const setItemsState = (id, checked) => {
    items[id - 1].checked = checked;
    renderKey.value = Date.now();
};

const gridItems = ref(32);
const itemSize = ref(1232 / gridItems.value);
const renderKey = ref(Date.now());

const channel = Echo.private("checkboxes");

channel.listenForWhisper("CheckboxUpdated", (e) => {
    setItemsState(e.id, e.checked);
});

const toggle = (id, checked) => {
    channel.whisper("CheckboxUpdated", { id, checked });
};
</script>

<template>
    <RecycleScroller
        class="flex-grow overflow-y-auto max-h-[720px] scrollbar-hide"
        :items="items"
        :item-size="itemSize"
        :grid-items="gridItems"
    >
        <template #default="{ item }">
            <div
                class="h-full flex items-center justify-center"
                :key="renderKey"
            >
                <input
                    type="checkbox"
                    class="size-6"
                    :checked="item.checked"
                    v-on:change="toggle(item.id, $event.target.checked)"
                />
            </div>
        </template>
    </RecycleScroller>
</template>

<style scoped></style>
