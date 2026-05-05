import type { Option } from "./meta.types";

export type Car = {
  id: number;

  title: string;
  price: number;
  year: number;
  mileage: number;
  location: string;

  engine_size?: number;
  horsepower?: number;
  color?: string;
  description?: string;

  make: Option;
  model: Option;
  fuel_type: Option;
  body_type: Option;
  transmission: Option;
  user_id: number;
};

export type CarPayload = {
  make_id: number;
  model_id: number;
  fuel_type_id: number;
  body_type_id: number;
  transmission_id: number;

  title: string;
  year: number;
  price: number;
  mileage: number;
  location: string;

  engine_size?: number | null;
  horsepower?: number | null;
  color?: string | null;
  description?: string | null;

  features?: number[];
};