<template>
    <div>
        <h3 class="text-center">{{ title }}</h3><br/>

      {{ content }}
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: '',
            content: ''
        }
    },
    created() {
        this.axios
            .get(`/api/static${window.location.pathname}`)
            .then(response => {
                this.title = response.data.title;
                this.content = response.data.content;
            });
    }
}
</script>
