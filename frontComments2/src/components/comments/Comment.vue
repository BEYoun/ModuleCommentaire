<template>
    <div class="comment">
      <div class="avatar"><img :src="'http://www.gravatar.com/avatar/'+comment.email_md5" alt=""></div>
      <div class="content">
        <span class="author">{{ comment.username  }}</span>
        <div class="metadata">
          <span class="date">{{ comment.created_at }}</span>
        </div>
        <div class="text">
          {{ comment.content }}
        </div>
        <div class="action">
          <a href="#">Repondre</a>
        </div>
      </div>
      <div class="comments">
        <comment :comment="reply" v-for="reply in comment.replies" :key="reply.id " :ip="ip"></comment>
      </div>
    </div>
</template>
<script type="text/babel">
export default {
  name: 'comment',
  props: {
    ip: String,
    comment: Object
  }
}
</script>
