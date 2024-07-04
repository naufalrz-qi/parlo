@extends($layout)

@section('content')
    <div class="container">
        <h1>Bookings</h1>
        <button id="download-pdf" class="btn btn-primary mb-3">Download PDF</button>
        <table id="bookings-table" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Destination</th>
                    <th>Facilities</th>
                    <th>Booking Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $key => $booking)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->destination->name }}</td>
                        <td>
                            @foreach($booking->facilities as $facility)
                                {{ $facility->name }}<br>
                            @endforeach
                        </td>
                        <td>{{ $booking->created_at }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                        <td>Rp{{ number_format($booking->total_price, 2, ',', '.') }}</td>
                        <td>{{ $booking->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
<script>
    document.getElementById('download-pdf').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
     // Add title
        doc.setFontSize(18);
        doc.text("Transaction Reports", 14, 22);
        const role = "{{ $role }}";
        const destinationName = "{{ $destinationName }}";


        if (role === 'employee') {
            doc.setFontSize(12);
            doc.text(`Destination: ${destinationName}`, 14, 42);

        }


        // Add period description
        const period = "Period: January 1, 2024 - December 31, 2024"; // Example period, modify as needed
        doc.setFontSize(12);
        doc.text(period, 14, 32);
       // Get table data
       const table = document.getElementById('bookings-table');
        let rows = table.getElementsByTagName('tr');

        let data = [];
        for (let i = 0; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let row = [];
            for (let j = 0; j < cells.length; j++) {
                row.push(cells[j].innerText);
            }
            if (row.length > 0) {
                data.push(row);
            }
        }

        const headers = [['No', 'User', 'Destination', 'Facilities', 'Booking Date', 'Start Time', 'End Time', 'Total Price', 'Status']];

        // Add table
        doc.autoTable({
            head: headers,
            body: data,
            startY: 52
        });

        // Save the PDF
        doc.save('Transactions Report.pdf');
    });
</script>
@endsection
