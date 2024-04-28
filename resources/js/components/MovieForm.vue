<template>
    <form @submit.prevent="submitForm">
      <div class="form-group mb-3">
        <label for="title" class="form-label">Movie Title</label>
        <input type="text" name="title" class="form-control" v-model="formData.title" required />
      </div>
  
      <div class="form-group mb-3">
        <label for="description" class="form-label">Movie Description</label>
        <input type="text" name="description" class="form-control" v-model="formData.description" required />
      </div>
  
      <div class="form-group mb-3">
        <label for="poster" class="form-label">Poster</label>
        <input type="file" class="form-control-file" id="poster" name="poster" accept="image/*" @change="handleFileUpload" />
      </div>
  
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const formData = ref({
    title: '',
    description: '',
    poster: null,
  });
  
  const submitForm = () => {
    const form = new FormData();
    form.append('title', formData.title);
    form.append('description', formData.description);
    form.append('poster', formData.poster);
    // Make an AJAX request to /api/v1/movies using Fetch API
    fetch('/api/v1/movies', {
      method: 'POST',
      body: form_data,
      headers: {
      'Accept': 'application/json',
      'Authorization': `Bearer ${your_jwt_token_here}`,
  },
})
    
    })
      .then(response => response.json())
      .then(data => {
        // Display a success message or handle the response data
        console.log(data);
      })
      .catch(error => {
        console.error(error);
      });
  };
  const handleFileUpload = event => {
    formData.poster = event.target.files[0];
  };
  </script>