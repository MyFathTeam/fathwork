<template>
    <div class="flex items-center space-x-1">
        <template v-for="star in rating">
            <span class="fa-stack" style="width:1em">
                <i class="far fa-star fa-lg text-yellow-500 fa-stack-1x"></i>
                <i v-if="star == 'full'" class="fas fa-star fa-lg text-yellow-500 fa-stack-1x"></i>
                <i v-else-if="star == 'half'" class="fas fa-star-half fa-lg text-yellow-500 fa-stack-1x"></i>
            </span>
        </template>
    </div>
</template>

<script>
export default {
    name: 'RatingStar'
}
</script>

<script setup>
const props = defineProps({
    rating: {
        type: Array,
        default: []
    }
})
</script>