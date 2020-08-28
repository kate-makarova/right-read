<template>
    <div>
        <h3 class="text-center">All Texts</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Site</th>
                <th>Date</th>
                <th>Title</th>
                <th>Link</th>
                <th>Known Words</th>
                <th>Unknown Words</th>
                <th>Status</th>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="text in texts" :key="text.id">
                <td>{{ text.site_name }}</td>
                <td>{{ text.publication_date }}</td>
                <td><router-link :to="{name: 'view', params: { id: text.id }}">{{ text.text_title }}</router-link></td>
                <td>{{ text.direct_link }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: text.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteBook(text.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
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
