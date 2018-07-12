require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueChatScroll from 'vue-chat-scroll'
import Toastr from 'toastr'
Vue.use(VueChatScroll)


Vue.component('message', require('./components/message.vue'));

const app = new Vue({
    el: '#app',
    data : {
    	message :'',
    	chat : {
    		message:[],
            user : [],
            color:[]
    	},
        typing:'',
        numberOfUsers:0
    },
    watch:{
        message(){
            Echo.private('nChat')
            .whisper('typing', {
                name: this.message
            });
        }
    },
    methods : {
    	send(){
    		if (this.message.length != 0) {
    			this.chat.message.push(this.message);
                this.chat.color.push('success');
                this.chat.user.push('you');

    			

                axios.post('send', {
                    message : this.message,
                    

                })
                .then(response => {
                    console.log(response);
                    this.message = '';
                })
                .catch(error => {
                    console.log(error);
                });
    		}
    	}
    },
    mounted(){
        Echo.private('nChat')
        .listen('ChatEvent', (e) => {
            this.chat.message.push(e.message);
            this.chat.user.push(e.user);
            this.chat.color.push('warning');

            // console.log(e);
        })
        .listenForWhisper('typing', (e) => {
            if (e.name != '') {

                this.typing = 'typing ...';
                
            }else {
                this.typing = '';
            }
        });

        Echo.join('nChat')
        .here((users) => {
            this.numberOfUsers = users.length;
            // console.log(users);
        })
        .joining((user) => {
            this.numberOfUsers++;
            Toastr.success(user.name+' is Join This Chat Room .');
            // console.log(user.name);
        })
        .leaving((user) => {
            this.numberOfUsers --;
            Toastr.warning(user.name+' is Leaved This Chat Room .');
            // console.log(user.name);
        });
    }
});
