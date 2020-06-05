<template>
  <div>
    <h3 class="ui header dividing">{{ reply==0 ? 'Commenter' : 'Répondre' }}</h3>
    <form action="" class="ui form" @submit.prevent="sendComment">
      <div class="two fields">
         <div class="field">
           <label>Pseudo</label>
           <input type="text" v-model="username">
         </div>
         <div class="field">
          <label>Email</label>
          <input type="text" v-model="email">
        </div>
        <div class="field">
          <label>content</label>
          <textarea v-model="content" cols="30" rows="10"></textarea>
        </div>
        <button class="ui blue labeled submit icon button">
          <i class="icon edit"></i>
          {{ reply==0 ? 'Commenter' : 'Répondre' }}
        </button>
      </div>
    </form>
  </div>
</template>
<script type="text/babel">
import { mapActions } from 'vuex'
export default {
  data () {
    return {
      username: '',
      email: '',
      content: '',
      loading: false
    }
  },

  props: {
    id: Number,
    model: String,
    reply: {
      type: Number,
      default: 0
    }
  },
  methods: {
    ...mapActions('commentaire', [
      'add_comment'
    ]),
    sendComment: function () {
      this.$store.dispatch('add_comment', {
        commentable_id: this.id,
        commentable_type: this.model,
        content: this.content,
        username: this.username,
        email: this.email,
        reply: this.reply
      }).catch((response) => {
        console.log('ERRORs', response)
      }).then(() => {
        this.loading = false
      })
    }
  }
}
</script>
