<div class="extra">
    <hr>
    <div class="row">
        <div class="col-md-6 block-extra">
            <div>
                <p><strong>Actividades recientes:</strong></p>
                @inject('notes','App\Http\Controllers\NoteService')
                @if($notes->getNotes()[0] && $notes->getNotes()[0] instanceof App\Note)
                    @foreach($notes->getNotes() as $note)
                        <p>
                            <strong>{{ $note->user->user }}</strong> {{ $note->content }}:
                            <strong>{{ $note->source }}</strong> ({{ $note->created_at->format('d-m-Y') }})
                        </p>
                    @endforeach
                @else
                    <p>{{ $notes->getNotes() }}</p>
                @endif
            </div>
        </div>
        <div class="col-md-6 block-extra">
            <div>
                <p><strong>Ultimos pagos:</strong></p>
                @inject('payments','App\Http\Controllers\PaymentService')
                @if($payments->getPayments()[0] && $payments->getPayments()[0] instanceof App\payment)
                    @foreach($payments->getPayments() as $payment)
                        <p>Pago <strong>{{ $payment->id }}</strong> con referencia <strong>{{ $payment->references }}</strong> por <strong>{{ $payment->mount }}</strong> bsf con estatus: <strong>{{ $payment->status }}</strong></p>
                    @endforeach
                @else
                    <p>{{ $payments->getPayments() }}</p>
                @endif
            </div>
        </div>
    </div>
</div>