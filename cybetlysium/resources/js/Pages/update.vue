<template>
	<Head title="Dashboard" />

<AuthenticatedLayout>
	<template #header>
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">Update</h2>
	</template>
	<form @submit.prevent="submit">
	  <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                  <div class="form-group">
                    <input type="hidden" class="form-control" v-model="form.id" >
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" v-model="form.name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
                  </div><br>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Age</label>
                    <input type="text" class="form-control" v-model="form.age" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter age">
                  </div><br>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Image</label><br>
                    <input type="file" @input="form.image = $event.target.files[0]" />
                  </div><br>
                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>

            </div>
        </div>
	</form>
	</AuthenticatedLayout>
  </template>

  <script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/inertia-vue3';
  import { useForm } from '@inertiajs/inertia-vue3'

    const props=defineProps({
        data:Array
    })

	  const form = useForm({
        id:props.data.id,
		name: props.data.name,
		age: props.data.age,
		image: null
	  })

	  function submit() {
		form.post('/update');
	  }
  </script>
