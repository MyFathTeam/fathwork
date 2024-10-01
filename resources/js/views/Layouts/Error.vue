<template>
    <ParentTransition appear :visibility="true">
        <div class="min-h-screen flex items-center bg-primary overflow-hidden">
            <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 py-4">
                <div class="bg-secondary rounded-lg px-4 py-16 sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
                    <div class="max-w-max mx-auto">
                        <ChildTransition direction="ltr">
                            <main class="sm:flex">
                                <router-view />
                            </main>
                        </ChildTransition>
                    </div>
                </div>
            </div>
        </div>
    </ParentTransition>
</template>

<script>
export default {

}
</script>
