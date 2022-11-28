import Cookie from "js-cookie";
import store from "../../store";

export default async function auth({
  to,
  next
}) {
  const token = Cookie.get("access_token") || null;
  const tokenStore = store.getters["auth/token"];
  const account = store.getters["auth/account"];
  const requiredAuth = to.matched.some(record => record.meta.requiresAuth);
  if (requiredAuth) {
    if (!token && !tokenStore) {
      next({
        path: "/login"
      });
    } else if (token && tokenStore) {
      await store.dispatch("common/getUserCommon");
    }
    next();
  } else {
    if (to.name === "Login" && token) {
      next({
        path: "/categories"
      });
    }
    next();
  }
  next();
}
