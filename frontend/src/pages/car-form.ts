import { carService } from '../services/car.service';
import { metaService } from '../services/meta.service';
import { router } from '../main';
import type { CarPayload, Feature } from '../types/car.types';
import { api } from '../api/axios';
import { Toast } from '../utils/toast';
import { hideLoading, showLoading } from '../ui/layouts/Overlay';

export function CarFormPage(params?: Record<string, string>): HTMLElement {
  const wrapper = document.createElement('div');

  const isEdit = !!params?.id;

  wrapper.innerHTML = `
    <h1 class="text-2xl font-semibold mb-4">
      ${isEdit ? 'Edit Car' : 'Create Car'}
    </h1>

    <div id="form" class="bg-white p-6 rounded shadow max-w-lg">
      Loading form...
    </div>
  `;

  // select helper func
  function createSelect(
    id: string,
    options: { id: number; name: string }[]
  ): HTMLSelectElement {

    const select = document.createElement('select');
    select.id = id;
    select.className = 'border p-2 w-full mb-3';
    
    options.forEach(opt => {
      const o = document.createElement('option');
      o.value = String(opt.id);
      o.textContent = opt.name;
      select.appendChild(o);
    });

    return select;
  }

  // input helper - for now here, later in utils...
  
  function createInput(id: string, placeholder: string, type = 'text') {
    const input = document.createElement('input');
    input.id = id;
    input.placeholder = placeholder;
    input.type = type;
    input.className = 'border p-2 w-full mb-3';
    return input;
  } 

  function createField(
    labelText: string,
    input: HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement
  ): HTMLElement {
    const wrapper = document.createElement('div');
    wrapper.className = 'mb-4';

    const label = document.createElement('label');
    label.textContent = labelText;
    label.className = 'block text-sm font-medium mb-1 text-gray-700';

    wrapper.appendChild(label);
    wrapper.appendChild(input);

    return wrapper;
  }

  const form = wrapper.querySelector('#form')!;

  metaService.getAll().then(async meta => {

    console.log('META:', meta);

    form.innerHTML = '';

    // SELECTS
    const make = createSelect('make_id', meta.makes);
    const model = createSelect('model_id', []);
    make.addEventListener('change', async () => {
      const makeId = make.value;

      const res = await api.get(`/api/makes/${makeId}/models`);

      const models = res.data;

      model.innerHTML = '';

      models.forEach((m: any) => {
        const opt = document.createElement('option');
        opt.value = String(m.id);
        opt.textContent = m.name;
        model.appendChild(opt);
      });
    });

    
    const fuel = createSelect('fuel_type_id', meta.fuel_types);
    const body = createSelect('body_type_id', meta.body_types);
    const transmission = createSelect('transmission_id', meta.transmissions);
 
    // INPUTS 
    
    const title = createInput('title', 'Title');
    const year = createInput('year', 'Year', 'number');
    const price = createInput('price', 'Price', 'number');
    const mileage = createInput('mileage', 'Mileage', 'number');
    const location = createInput('location', 'Location'); 

    // Form inputs PART II:
    const engineSize = createInput('engine_size', 'Engine size (e.g. 2.0)');
    const horsepower = createInput('horsepower', 'Horsepower', 'number');
    const color = createInput('color', 'Color');
    const description = document.createElement('textarea');
    description.id = 'description';
    description.placeholder = 'Description';
    description.className = 'border p-2 w-full mb-3';

    const btn = document.createElement('button');
    btn.textContent = isEdit ? 'Update' : 'Create';
    btn.className = 'bg-blue-500 text-white w-full py-2 rounded';

    // Part III (features - check):

    const featuresWrapper = document.createElement('div');
    featuresWrapper.className = 'mb-4';

    const featuresTitle = document.createElement('p');
    featuresTitle.textContent = 'Features';
    featuresTitle.className = 'text-sm font-medium mb-2 text-gray-700';

    featuresWrapper.appendChild(featuresTitle);

    const selectedFeatures: number[] = [];

    meta.features.forEach((f: Feature )  => {
      const label = document.createElement('label');
      label.className = 'flex items-center gap-2 text-sm mb-1';

      const checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.value = String(f.id);

      checkbox.addEventListener('change', () => {
        const id = Number(checkbox.value);

        if (checkbox.checked) {
          selectedFeatures.push(id);
        } else {
          const index = selectedFeatures.indexOf(id);
          if (index > -1) selectedFeatures.splice(index, 1);
        }
      });

      label.appendChild(checkbox);
      label.append(f.name);

      featuresWrapper.appendChild(label);
    });

    // EDIT
    if (isEdit) {
      const car = await carService.getOne(Number(params!.id));

      make.value = String(car.make.id);

      const res = await api.get(`/api/makes/${car.make.id}/models`);
      const models = res.data;

      model.innerHTML = '';

      models.forEach((m: any) => {
        const opt = document.createElement('option');
        opt.value = String(m.id);
        opt.textContent = m.name;
        model.appendChild(opt);
      });

      model.value = String(car.model.id);
      fuel.value = String(car.fuel_type.id);
      body.value = String(car.body_type.id);
      transmission.value = String(car.transmission.id);

      title.value = car.title;
      year.value = String(car.year);
      price.value = String(car.price);
      mileage.value = String(car.mileage);
      location.value = car.location;

      // Form inputs in edit Part II:

      engineSize.value = String(car.engine_size) ?? '';
      horsepower.value = car.horsepower ? String(car.horsepower) : '';
      color.value = String(car.color) ?? '';
      description.value = String(car.description) ?? '';

      // Part III - features:

      selectedFeatures.push(...car.features.map((f: Feature) => f.id));

      featuresWrapper.querySelectorAll('input[type="checkbox"]').forEach((el: any) => {
        if (selectedFeatures.includes(Number(el.value))) {
          el.checked = true;
        }
      });
    }

    // SUBMIT
    btn.addEventListener('click', async () => {
      const data: CarPayload = {
        make_id: Number(make.value),
        model_id: Number(model.value),
        fuel_type_id: Number(fuel.value),
        body_type_id: Number(body.value),
        transmission_id: Number(transmission.value),

        title: title.value,
        year: Number(year.value),
        price: Number(price.value),
        mileage: Number(mileage.value),
        location: location.value,

        // part II:

        engine_size: engineSize.value ? Number(engineSize.value) : null,
        horsepower: horsepower.value ? Number(horsepower.value) : null,
        color: color.value || null,
        description: description.value || null,

        //part III

        features: selectedFeatures ?? [],
      };

      showLoading();

      try {
        if (isEdit) {
          await carService.update(Number(params!.id), data);
          Toast.success('Car updated successfully');
        } else {
          await carService.create(data);
          Toast.success('Car created successfully');
        }

        router.navigate('/cars');

      } catch (e: any) {
        console.error(e);

        const status = e?.response?.status;

        if (status === 403) {
          Toast.error('You are not allowed to edit this car');
          return;
        }

        if (status === 422) {
          Toast.error('Validation failed');
          return;
        }

        Toast.error('Something went wrong');
      } finally {
        hideLoading()
      }
    });

    form.append(
      createField('Make', make),
      createField('Model', model),
      createField('Fuel', fuel),
      createField('Body', body),
      createField('Transmission', transmission),
      createField('Title', title),
      createField('Year', year),
      createField('Price', price),
      createField('Mileage', mileage),
      createField('Location', location),
      //part II
      createField('Engine size', engineSize),
      createField('Horsepower', horsepower),
      createField('Color', color),
      createField('Car description', description),
      featuresWrapper,
      btn
    );
  });

  return wrapper;
}