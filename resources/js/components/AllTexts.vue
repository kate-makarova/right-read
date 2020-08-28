<template>
    <div>
        <div class="list-group">
            <div v-for="text in texts" :key="text.id" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <div>
                        <h5 class="mb-1">
                            <router-link :to="{name: 'view', params: { id: text.id }}">{{ text.text_title }}
                            </router-link>
                        </h5>

                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus
                            varius blandit.</p>
                        <small><a :href="text.direct_link">{{ text.site_name }}</a> {{ text.publication_date }}</small>
                    </div>
                    <div>
                        <h3><span class="badge badge-secondary">25/50</span></h3>
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
            .get('/api/texts')
            .then(response => {
                this.texts = response.data;
            });
    },
    methods: {
        deleteBook(id) {
            this.axios
                .delete(`/api/text/delete/${id}`)
                .then(response => {
                    let i = this.texts.map(item => item.id).indexOf(id); // find index of your object
                    this.texts.splice(i, 1)
                });
        }
    }
}
</script>
