<template>
    <div>
        <h3 class="text-center">{{ text.text_title }}</h3><br/>
        <article>
            <span v-html="text.text_content"></span>
        </article>
    </div>
</template>

<script>
export default {
    data() {
        return {
            text: {}
        }
    },
    created() {
        this.axios
            .get(`/api/text/view/${this.$route.params.id}`)
            .then(response => {
                this.text = response.data;
            });
    },
    methods: {
        addKnownWord(word) {
            this.axios
                .post(`/api/word/add/${word}`)
                .then(response => {
                    console.log('added');
                });
        }
    }
}
</script>
