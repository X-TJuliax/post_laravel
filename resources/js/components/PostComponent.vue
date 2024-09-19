<template>
    <div>
      <h1>Blog</h1>
      <input v-model="newPost.title" placeholder="Title" />
      <textarea v-model="newPost.body" placeholder="Body"></textarea>
      <button @click="createPost">Create Post</button>
  
      <ul>
        <li v-for="post in posts" :key="post.id">
          <h3>{{ post.title }}</h3>
          <p>{{ post.body }}</p>
           <button @click="deletePost(post.id)">Delete</button>
          <button @click="editPost(post)">Edit</button> 
        </li>
      </ul>
  
      <div v-if="editingPost">
        <input v-model="editingPost.title" />
        <textarea v-model="editingPost.body"></textarea>
        <button @click="updatePost">Update</button>
      </div> 
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        posts: [],
        newPost: { title: '', body: '' },
        editingPost: null,
      };
    },
    mounted() {
      this.fetchPosts();
    },
    methods: {
      async fetchPosts() {
        const response = await axios.get('/posts');
        this.posts = response.data;
      },
      async createPost() {
        await axios.post('/posts', this.newPost);
        this.newPost = { title: '', body: '' };
        this.fetchPosts();
      },
      async deletePost(id) {
        await axios.delete(`/posts/${id}`);
        this.fetchPosts();
      },
      editPost(post) {
        this.editingPost = { ...post };
      },
      async updatePost() {
        await axios.put(`/posts/${this.editingPost.id}`, this.editingPost);
        this.editingPost = null;
        this.fetchPosts();
      },
    },
  };
  </script>
  