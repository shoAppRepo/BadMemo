const state = {
    token:'',
    id: '',
    name: '',
  };
  
  const mutations = {
    getAuthId(state, token){
      state.token = token;
    },
    getAuthId(state, id){
      state.id = id;
    },
    getAuthName(state, name){
      state.name = name;
    }
  };
  
  export default {
    namespaced: true,
    state,
    mutations,
  };