<template>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-700 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-neutral-700">
                            <tr>
                                <slot name="header"></slot>
                            </tr>
                        </thead>
                        <tbody>
                            <slot></slot>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'BaseTable'
}
</script>

<script setup>
import { provide } from "vue"

provide("Header", [])
provide("SubHeader", [])
</script>