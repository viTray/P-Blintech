import axios from 'axios';

export default {
    url: '',
    init(table, type = 'application/json') {
        this.url = 'http://127.0.0.1:8000/api/' + table;
        let stoken = localStorage.getItem('token');
        axios.defaults.headers = {
            'Content-Type': type,
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + stoken
        }
    },
    all(state = '', type = '', id = 0) {
        // eslint-disable-next-line no-undef
        return axios.get(this.url, { params: { state: state, type: type, id: id } });
    },
    find(id, state = 'all') {
        return axios.get(this.url + '/' + id, { params: { state: state } });
    },
    create(data) {
        return axios.post(this.url, data)
    },
    update(id, data) {
        return axios.put(this.url + '/' + id, data);
    },
    delete(id) {
        return axios.delete(this.url + '/' + id);
    },

};