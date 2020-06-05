<template>
  <div class="ui comments">
    <div class="ui inverted active dimmer" v-if="loading">
      <div class="ui text loader">Récupération des commentaires </div>
    </div>
    <comment :comment="comment" :ip="ip"  v-for="comment in comments" :key="comment.id"></comment>
    <comment-form :id="id" :model="model "></comment-form>
  </div>
</template>
<script type="text/babel">
import Comment from './comments/Comment.vue'
import CommentForm from './comments/Form.vue'
import { mapActions, mapGetters } from 'vuex'
export default {
  data () {
    return {
      loading: true
    }
  },
  methods: {
    ...mapActions('commentaire', [
      'get_comments'
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
    this.$store.dispatch('get_comments', {model: this.model, id: this.id}).then(() => {
      this.loading = false
    })
  }
}
</script>
