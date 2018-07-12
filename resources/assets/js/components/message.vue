<template>
    <div>
        <li class="list-group-item" :class="className"><slot></slot><small class="badge float-right" :class="badgeClass">{{ user }}</small></li>
        
    </div>

</template>

<script>
    export default {
        props: [
            'color',
            'user'
        ],

        computed:{
            className(){
                return 'list-group-item-'+this.color;
            },

            badgeClass(){
                return 'badge-'+this.color;
            }
        }
    }
</script>
