import Cookie from "js-cookie";
import store from "../../store";

export default async function redirectCallback({ to, next }) {
  const token = Cookie.get("access_token") || null;
  const tokenStore = store.getters["auth/token"];
  const callbackUrl = store.getters["auth/callback"];
  if (to.name === 'Login') {
    store.commit('auth/SET_CALLBACK_URL', to.query.callback_url);
  }
  next();
}
