<script setup>
import { RecycleScroller } from "vue-virtual-scroller";
import { ref } from "vue";
import Bitset from "bitset";
import { useElementBounding } from "@vueuse/core";

// Define component props (State is string of 0s and 1s, count is number of checkboxes)
const props = defineProps({
    state: String,
    count: Number,
});

// Initialize bitset for checkbox states
const bitset = new Bitset();

// Convert string state to bitset
for (let i = 0; i < props.state.length; i++) {
    bitset.set(i, Number(props.state.charAt(i)));
}

// Create array of 1 million checkbox items
let items = [...Array(1000000).keys()].map((index) => {
    return {
        id: index + 1,
        checked: bitset.get(index + 1),
    };
});

// Update item state and trigger re-render
const setItemsState = (id, checked) => {
    items[id - 1].checked = checked;
    renderKey.value = Date.now();
};

// Refs for scroller configuration
const scroller = ref(null);
const gridItems = ref(32);
const itemSize = ref(1232 / gridItems.value);
const renderKey = ref(Date.now());

// Handle resize to adjust grid layout
const onResize = () => {
    const { width } = useElementBounding(scroller);
    gridItems.value = Math.floor(width.value / itemSize.value);
};

// Setup private websocket channel
const channel = Echo.private("checkboxes");

// Listen for checkbox updates from other clients
channel.listenForWhisper("CheckboxUpdated", (e) => {
    setItemsState(e.id, e.checked);
});

// Broadcast checkbox changes to other clients
const toggle = (id, checked) => {
    channel.whisper("CheckboxUpdated", { id, checked });
};
</script>

<template>
    <RecycleScroller
        ref="scroller"
        class="flex-grow overflow-y-auto max-h-[720px] scrollbar-hide"
        :items="items"
        :item-size="itemSize"
        :grid-items="gridItems"
        v-on:resize="onResize"
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
