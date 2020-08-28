<template>
    <component :is="compiled"/>
</template>


<script>

export default {
    name: "TextContent",
    props: ['content'],
    data() {
        return {
            compiled: null
        }
    },
    mounted() {
        Vue.component('WordTag', {
            template: '<span class="text-tag" :data-tag="tag" v-on:click="addKnownWord">{{ word }}</span>',
            props: ['word', 'tag'],
            methods: {
                addKnownWord: function (event) {
                    this.axios
                        .post(`/api/word/add/${event.target.innerHTML}`)
                        .then(response => {
                            console.log(event.target.innerHTML);
                        });
                }
            },
        });

        this.compiled = Vue.compile(this.content);
    }
}
</script>

<style scoped>

</style>
