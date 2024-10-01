export default [
  {
    path: "productcategories",
    name: "ProductCategory",
    redirect: { name: "ProductCategoryList" },
    meta: {
      label: "master.productcategory.productcategory",
      icon: "fa-solid fa-arrow-right",
      hideChildren: true,
      permissions: ['productcategory:read']
    },
    component: {
      template: "<router-view></router-view>",
    },
    children: [
      {
        path: "",
        name: "ProductCategoryList",
        meta: {
          trans: "global.list",
          label: "master.productcategory.productcategory",
        },
        component: () =>
          import("@views/Pages/Master/ProductCategory/Index.vue"),
      },
      {
        path: "create",
        name: "ProductCategoryCreate",
        meta: {
          type: "create",
          action: "create",
          trans: "global.add",
          label: "master.productcategory.productcategory",
          permissions: ['productcategory:create']
        },
        component: () =>
          import("@views/Pages/Master/ProductCategory/Action.vue"),
      },
      {
        path: ":uuid/edit",
        name: "ProductCategoryEdit",
        meta: {
          type: "edit",
          action: "update",
          trans: "global.edit",
          label: "master.productcategory.productcategory",
          permissions: ['productcategory:edit']
        },
        component: () =>
          import("@views/Pages/Master/ProductCategory/Action.vue"),
      },
      {
        path: ":uuid/duplicate",
        name: "ProductCategoryDuplicate",
        meta: {
          type: "duplicate",
          action: "create",
          trans: "global.duplicate",
          label: "master.productcategory.productcategory",
          permissions: ['productcategory:create']
        },
        component: () =>
          import("@views/Pages/Master/ProductCategory/Action.vue"),
      },
      {
        path: ":uuid",
        name: "ProductCategoryShow",
        meta: {
          trans: "global.detail",
          label: "master.productcategory.productcategory",
          permissions: ['productcategory:read']
        },
        component: () => import("@views/Pages/Master/ProductCategory/Show.vue"),
      },
    ],
  },
];
