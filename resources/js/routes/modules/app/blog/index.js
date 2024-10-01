import post from "./post";
import postcategory from "./postcategory";

export default [
  {
    path: "blog",
    name: "Blog",
    redirect: { name: "BlogList" },
    meta: {
      label: "blog.blog",
      icon: "fa-solid fa-photo-film",
      hideChildren: false,
    },
    component: {
      template: "<router-view></router-view>",
    },
    children: [...postcategory, ...post],
  },
];
