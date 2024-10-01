import axios from "axios";
import * as Api from "@core/apis";
import * as Form from "@core/utils/form";
import { useToast } from "vue-toastification";
import { mutations, actions, getters } from "@stores/global";

const toast = useToast();

import post from "@stores/modules/blog/post";
import postcategory from "@stores/modules/blog/postcategory";

const initialState = () => ({
  initURL: "/app/blog",
  formErrors: {},
});

const blog = {
  namespaced: true,
  state: initialState,
  modules: {
    post,
    postcategory,
  },
  mutations: {
    ...mutations,
  },
  actions: {
    ...actions,
  },
  getters: {
    ...getters,
  },
};

export default blog;
