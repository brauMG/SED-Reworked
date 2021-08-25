const app = new Vue({
    el: '#editArea',
    data: {
        area: {}
    },
    mounted() {
        axios.get('/admins/area/Edit/editArea').then(response => this.area = response.data);
    }
});
