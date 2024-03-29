    function getDaysWeekdays() {
        const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const DaysWeekdays = [];

        for (let i = 6; i >= 0; i--) {
            const currentDate = new Date();
            currentDate.setDate(currentDate.getDate() - i);
            const dayIndex = currentDate.getDay();
            const formattedDate = currentDate.toLocaleDateString('id-ID', { weekday: 'long' });
            DaysWeekdays.push(formattedDate);
        }

        return DaysWeekdays;
    }

    document.addEventListener('DOMContentLoaded', function() {
        $.ajax({
            url: '/get_transaksi',
            method: 'GET',
            dataType: 'json',
            success: function(responseData) {
                console.log(responseData);

                const labels = getDaysWeekdays();
                const dataValues = getDaysWeekdays().map(day => {
                    const matchingData = responseData.filter(entry => {
                        const entryDay = new Date(entry.created_at).toLocaleDateString('id-ID', { weekday: 'long' });
                        return entryDay === day;
                    });

                    const totalQty = matchingData.reduce((acc, entry) => acc + entry.qty, 0);

                    return totalQty;
                });

                const ctx = document.getElementById('myChart');

                if (ctx) {
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Penjualan 7 hari terakhir',
                                data: dataValues,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } else {
                    console.error('Elemen dengan ID myChart tidak ditemukan.');
                }
            },
            error: function() {
                console.error('Gagal memuat data dari controller.');
            }
        });
    });
