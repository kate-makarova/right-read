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
            .get(`/text/view/${this.$route.params.id}`)
            .then(response => {
                this.text = response.data;
            });
    }
}

</script>
