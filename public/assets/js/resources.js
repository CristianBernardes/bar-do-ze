class CRUD {

    /**
     * @param  {} allURI
     * @param  {} createURI
     * @param  {} updateURI
     * @param  {} readURI
     * @param  {} deleteURI
     */
    constructor(allURI, createURI, updateURI, readURI, deleteURI) {
        this.allURI = allURI;
        this.createURI = createURI;
        this.updateURI = updateURI;
        this.readURI = readURI;
        this.deleteURI = deleteURI;
        this.axios = axios.create({
            baseURL: window.location.origin,
        });
    }

    /**
     *
     */
    async all() {
        try {
            const response = await this.axios.get(`${this.allURI}`);
            return response.data;
        } catch (error) {
            throw error;
        }
    }

    /**
     * @param  {} data
     */
    async create(data) {
        let header = { 'Content-Type': 'application/json' };
        if (data.get('file')) {
            header = { 'Content-Type': 'multipart/form-data' };
        } else {
            data = JSON.stringify(data);
        }
        try {
            const response = await this.axios.post(this.createURI, data, { headers: header });
            return response.data;
        } catch (error) {
            throw error;
        }
    }

    /**
     * @param  {} id
     * @param  {} data
     */
    async update(id, data) {
        let header = { 'Content-Type': 'application/json' };
        if (data.get('file')) {
            header = { 'Content-Type': 'multipart/form-data' };
        } else {
            data = JSON.stringify(data);
        }
        try {
            const response = await this.axios.put(`${this.updateURI}/${id}`, data, { headers: header });
            return response.data;
        } catch (error) {
            throw error;
        }
    }


    /**
     * @param  {} id
     */
    async read(id) {
        try {
            const response = await this.axios.get(`${this.readURI}/${id}`);
            return response.data;
        } catch (error) {
            throw error;
        }
    }

    /**
     * @param  {} id
     */
    async delete(id) {
        try {
            const response = await this.axios.delete(`${this.deleteURI}/${id}`);
            return response.data;
        } catch (error) {
            throw error;
        }
    }
}
