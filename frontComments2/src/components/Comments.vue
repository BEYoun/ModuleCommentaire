<template>
  <div class="ui comments">
    {{ comments }}
  </div>
</template>
<script type="text/babel">
import axios from 'axios'
export default {
  data () {
    return {
      comments: []
    }
  },
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
        this.comments = response.data
      })
  }
}
</script>
