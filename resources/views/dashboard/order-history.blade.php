@extends('common.dashboard')
@section('title', $title)
@section('sub-content')
    <div class="rts-reviewd-area-dashed table-responsive" style="white-space: nowrap;">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h5 class="title">Order History</h5>
                <table class="table-reviews quiz mb--0">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Order ID</th>
                            <th style="width: 40%;">Course Name</th>
                            <th style="width: 20%;">Date</th>
                            <th style="width: 15%;">Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>
                                    <div class="information-quiz">
                                        <p class="quiz">{{ $order->id }}</p>
                                    </div>
                                </td>
                                <td>
                                    <span class="questions">{{ $order->course->name }}</span>
                                </td>
                                <td>
                                    <span class="marks">{{ _date($order->date) }}</span>
                                </td>
                                <td>
                                    <span>{{ printPrice($order->amount) }}</span>
                                </td>
                                <td>
                                    <div class="hold-area">
                                        <span
                                            class="{{ $order->status == 'Paid' ? 'processing' : 'hold' }}">{{ $order->status }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No record found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">{{ $orders->links() }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
