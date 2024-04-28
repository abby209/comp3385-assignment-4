<template>
    <div class="movies-container">
      <div v-for="movie in movies" :key="movie.id" class="movie-card">
        <img :src="movie.poster" alt="Movie Poster">
        <h2>{{ movie.title }}</h2>
        <p>{{ movie.description }}</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const movies = ref([]);
  
  const fetchMovies = async () => {
    try {
      const response = await axios.get('/api/v1/movies');
      movies.value = response.data;
    } catch (error) {
      console.error('Error fetching movies:', error);
    }
  };
  
  onMounted(fetchMovies);
  </script>