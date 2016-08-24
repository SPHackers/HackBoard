<template>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Currency (CAD/USD)</div>
            <div class="panel-body">
                <p><strong>Today rate:</strong> {{rate}}</p>
                <p><strong>Last week average:</strong> {{rate}}</p>
                <p><strong>Last month average:</strong> {{rate}}</p>
                <p><strong>Last 6 months average:</strong> {{rate}}<p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        ready() {
            this.fetchLiveRate('CAD');
        },
        data: function () {
            return {
                rate: ''
            };
        },
        methods: {
            fetchLiveRate(currency) {
                this.$http.get('https://api.fixer.io/latest?base=USD').then((response) => {
                    this.$set('rate', response.data.rates[currency]);
                });
            }
        },
    }
</script>
