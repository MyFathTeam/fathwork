export default [
  {
    path: "postcategories",
    name: "PostCategory",
    redirect: { name: "PostCategoryList" },
    meta: {
      label: "blog.postcategory.postcategory",
      icon: "fa-solid fa-arrow-right",
      hideChildren: true,
      permissions: ['postcategory:read']
    },
    component: {
      template: "<router-view></router-view>",
    },
    children: [
      {
        path: "",
        name: "PostCategoryList",
        meta: {
          trans: "global.list",
          label: "blog.postcategory.postcategory",
        },
        component: () =>
          import("@views/Pages/Blog/PostCategory/Index.vue"),
      },
      {
        path: "create",
        name: "PostCategoryCreate",
        meta: {
          type: "create",
          action: "create",
          trans: "global.add",
          label: "blog.postcategory.postcategory",
          permissions: ['postcategory:create']
        },
        component: () =>
          import("@views/Pages/Blog/PostCategory/Action.vue"),
      },
      {
        path: ":uuid/edit",
        name: "PostCategoryEdit",
        meta: {
          type: "edit",
          action: "update",
          trans: "global.edit",
          label: "blog.postcategory.postcategory",
          permissions: ['postcategory:edit']
        },
        component: () =>
          import("@views/Pages/Blog/PostCategory/Action.vue"),
      },
      {
        path: ":uuid/duplicate",
        name: "PostCategoryDuplicate",
        meta: {
          type: "duplicate",
          action: "create",
          trans: "global.duplicate",
          label: "blog.postcategory.postcategory",
          permissions: ['postcategory:create']
        },
        component: () =>
          import("@views/Pages/Blog/PostCategory/Action.vue"),
      },
      {
        path: ":uuid",
        name: "PostCategoryShow",
        meta: {
          trans: "global.detail",
          label: "blog.postcategory.postcategory",
          permissions: ['postcategory:read']
        },
        component: () => import("@views/Pages/Blog/PostCategory/Show.vue"),
      },
    ],
  },
];
