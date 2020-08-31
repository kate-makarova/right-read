<template>
    <div>
        <div class="list-group">
            <div v-for="text in texts" :key="text.id" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <div>
                        <h5 class="mb-1">
                            <a :href="text.direct_link">{{ text.text_title }}</a>
                        </h5>
                        <small>{{ text.site_name }} {{ text.publication_date }}</small>
                    </div>
                    <div>
                        <h3><span class="badge badge-secondary">{{ text.percentage }}</span></h3>
                    </div>
                    <div>
                        <h3><span class="badge badge-secondary">{{ text.known_words }}/{{ text.total_words }}</span></h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            texts: []
        }
    },
    created() {
        this.axios
            .get('/texts')
            .then(response => {
                this.texts = response.data;
            });
    }
}
</script>
