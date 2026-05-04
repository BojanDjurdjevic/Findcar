import { api } from '../api/axios';

export const metaService = {
  async getAll() {
    const res = await api.get('/api/meta/filters');
    return res.data;
  },
};