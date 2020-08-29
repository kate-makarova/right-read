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
                        .post(`/word/add/${event.target.innerHTML}`)
                        .then(response => {
                            console.log(response.data);

                            Array.from(document.querySelectorAll('.text-tag'))
                                .filter(el => el.textContent === event.target.innerHTML)
                                .forEach(function(el) {
                                    el.setAttribute('data-tag', 'known');
                                });

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
