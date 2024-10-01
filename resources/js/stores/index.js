import { createStore } from "vuex";

import setup from "@stores/modules/setup";
import navigation from "@stores/modules/navigation";
import config from "@stores/modules/config";
import layout from "@stores/modules/layout";
import dashboard from "@stores/modules/dashboard";
import image from "@stores/modules/image";
import auth from "@stores/modules/auth";
import user from "@stores/modules/user";
import utility from "@stores/modules/utility";
import project from "@stores/modules/project";
import master from "@stores/modules/master";
import faththink from "@stores/modules/faththink";
import blog from "@stores/modules/blog";
import option from "@stores/modules/option";
import tag from "@stores/modules/tag";
import moduleImport from "@stores/modules/moduleImport";

const initialState = () => ({});

const store = createStore({
  modules: {
    setup,
    navigation,
    config,
    layout,
    dashboard,
    image,
    auth,
    user,
    project,
    master,
    blog,
    utility,
    option,
    tag,
    moduleImport,
    faththink,
  },
  state: initialState,
  mutations: {},
  actions: {},
  getters: {},
});

export default store;
