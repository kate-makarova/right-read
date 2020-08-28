<template>
    <div>
        <h3 class="text-center">{{ text.text_title }}</h3><br/>
        <article>
            <TextContent v-if="text.text_content" v-bind:content="text.text_content"/>
        </article>
    </div>
</template>

<script>
import TextContent from "./TextContent";

export default {
    data() {
        return {
            text: {}
        }
    },
    components: {
        TextContent: TextContent
    },
    created() {
        this.axios
            .get(`/api/text/view/${this.$route.params.id}`)
            .then(response => {
                this.text = response.data;
            });
    },
    methods: {
        addKnownWord: function(event) {
            this.axios
                .post(`/api/word/add/${event.target.content}`)
                .then(response => {
                    console.log(event.target.content);
                });
        }
    }
}

</script>
