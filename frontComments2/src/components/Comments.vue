<template>
  <div class="ui comments">
    <comment :comment="comment" :ip="ip"  v-for="comment in comments" :key="comment.id"></comment>
    <comment-form :id="id" :model="model "></comment-form>
  </div>
</template>
<script type="text/babel">
import axios from 'axios'
import Comment from './comments/Comment.vue'
import CommentForm from './comments/Form.vue'
import { mapActions, mapGetters } from 'vuex'
export default {

  methods: {
    ...mapActions('commentaire', [
      'add_comments'
    ])
  },
  computed: {
    ...mapGetters([
      'comments'
    ])
  },
  components: { Comment, CommentForm },
  props: {
    id: Number,
    model: String,
    csrf: String,
    ip: String
  },
  created: function () {
    axios
      .get('/comments', { params: { id: this.id, type: this.model } })
      .then(response => {
        this.$store.dispatch('add_comments', response.data)
      })
  }
}
</script>
