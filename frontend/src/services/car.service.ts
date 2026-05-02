import { api } from '../api/axios';
import type { Car } from '../types/car.types';

export const carService = {
  async getAll(): Promise<Car[]> {
    const res = await api.get('/api/cars');
    console.log(res.data)
    return res.data.data; 
  },

  async getOne(id: number): Promise<Car> {
    const res = await api.get(`/api/cars/${id}`);
    return res.data.data ?? res.data;
  },

  async create(data: Partial<Car>): Promise<Car> {
    const res = await api.post('/api/cars', data);
    return res.data.data ?? res.data;
  },

  async update(id: number, data: Partial<Car>): Promise<Car> {
    const res = await api.put(`/api/cars/${id}`, data);
    return res.data.data ?? res.data;
  },

  async delete(id: number): Promise<void> {
    await api.delete(`/api/cars/${id}`);
  },
};