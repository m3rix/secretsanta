<template>
  <div>
    <hero />
    <hr />
    <home-content />
  </div>
</template>

<script>
import Hero from "../components/Hero";

export default {
  name: "home-view",
  components: {
    Hero,
  },
};
</script>

<style lang="css" scoped>
.next-steps .fa-link {
    margin-right: 5px;
}
</style>
