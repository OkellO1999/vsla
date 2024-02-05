@include('layouts.savings')
<div class="h-full px-6 py-4 w-full overflow-auto bg-gray-100">
    <h2 class=" mt-4 mb-4 max-sm:text-center text-gray-400">Payments/<strong>{{ Auth::user()->name }}</strong></h2>
    <div class=" overflow-auto flex gap-4 max-sm:block w-full">
        <form action="{{ route('savings.transactions') }}" method="post" class=" py-4 px-4 rounded-xl border-t-4 border-gray-400 shadow-xl w-full bg-white">
          @csrf
          @method('post')
          
          <h1 class=" mb-4 text-center text-gray-400">Make Payments</h1>
            <hr>
            <div>
              <h2>

              </h2>
            </div>
           @if (Session::has('message'))
           <div class=" text-white bg-green-300 border-2 border-gray-700 py-4 px-2 rounded text-xl">
             {{ session('message') }}
           </div>
           @endif
           @if (Session::has('errorMessage'))
           <div class=" text-white border-2 border-orange-700 bg-red-800 py-4 px-2 rounded text-xl">
             {{ session('errorMessage') }}
           </div>
           @endif
            <div class=" mb-4 mt-4">
              @error('contact')
                {{ $error }}
              @enderror
              <x-text-input type="tel" name="contact" value="{{old('contact')}}" id="" placeholder="Enter mobile money number"></x-text-input>
              @error('contact')
              {{ $error }}
              @enderror
              <x-text-input type="number" name="amount" value="{{ old('amount') }}" id="" placeholder="Input Amount e.g 10000"></x-text-input>
              <select name="paymentType" id="paymentType" onchange="handleChange()" class=" py-2 px-2 border border-gray-400 w-full mb-2 rounded focus:outline-gray-400 mt-2">
                <option value="" disabled selected class=" bg-gray-400">--Select Payment Type--</option>
                <option value="savings">Savings Deposit</option>
                <option value="welfare">Welfare Deposit</option>
                <option value="disaster">Disaster & Preparedness Deposit</option>
                <option value="shares">Share Payment</option>
                <option value="activation fee">Account Activation Fee</option>
                <option value="loans">Loan Re-Payment</option>
                <option value="welfare loan-repayment">Welfare Loan Re-Payement</option>
              </select>
              <select name="payFor" id="payFor" onchange="handleChange()" class=" py-2 px-2 border border-gray-400 w-full mb-2 rounded focus:outline-gray-400 mt-2">
                <option value="" disabled selected>--Select who you are paying for--</option>
                <option value="self">Pay For self</option>
                <option value="others">Pay For others</option>
              </select>
              <select name="userType" onchange="handleChange()" id="userType" class=" py-2 px-2 border border-gray-400 w-full mb-2 rounded focus:outline-gray-400 mt-2" style="display:none;">
                <option value="" disabled selected>--Select user type--</option>
                <option value="member">Member</option>
                <option value="non_member">Non Member</option>
              </select>
              <select name="nonMember" id="nonMemberSelection" class=" py-2 px-2 border border-gray-400 w-full mb-2 rounded focus:outline-gray-400 mt-2" style="display:none;">
                <option value="" disabled selected>--Non member you are paying for--</option>
                @if (count($nonmembers))
                  
                @foreach ($nonmembers as $nonmember)
                  
                <option value="{{ $nonmember->id }}">{{ $nonmember->name }}</option>
                @endforeach
                @else
                  <option value="" disabled>There are currently no non members with loans</option>
                @endif
            
              </select>

              <select name="member" id="memberYouArePayingFor" class=" py-2 px-2 border border-gray-400 w-full mb-2 rounded focus:outline-gray-400 mt-2" style="display:none;">
                <option value="" disabled selected>--Choose who you are paying for--</option>
                @if (count($members))
                
                  
                @foreach ($members as $member)
                <option id="members" style="display:block;" value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
                @elseif (count($membersWithLoans))
                @foreach ($membersWithLoans as $memberWithLoan)
                <option id="groupMember" style="display:none;" value="{{ $memberWithLoan->id }}">{{ $memberWithLoan->name }}</option>
                @endforeach
                @else
                  <option value="" disabled>Not Found</option>
                @endif
              </select>
            </div>
            <hr>
            <div>
              <h2 class=" text-center text-gray-400 mb-4 mt-4">Select Payment methods</h2>
              <hr class=" mb-4">
              <select name="paymethod" id="" class=" py-2 px-2 border border-gray-400 w-full mb-2 rounded focus:outline-gray-400 mt-2">
                <option value="" selected disabled>Select Payment Method</option>

                  <option value="MTN">MTN MobileMoney</option>

                  <option value="Airtel">AirtelMoney</option>
              </select>


            </div>

            <x-primary-button>Confirm payment</x-primary-button>
            
          </form>
          <script>
            function handleChange(){
           var sel = document.getElementById('paymentType').value;
           var field = document.getElementById('groupMember')
           console.log(field)
           var selvalue = document.getElementById('payFor').value;
           var sel3 = document.getElementById('userType').value;
           if(sel === 'loans' && selvalue === 'others'){
             document.getElementById('userType').style.display="block";
             
            }else {
              document.getElementById('userType').style.display="none";
            }
            if(sel === 'loans' && sel3 === 'member'){
            field.style.display="block";
             document.getElementById('members').style.display="none";

            }else{
              document.getElementById('members').style.display="block";

            }
            
            if(sel !== 'loans' && selvalue === 'others'){
              document.getElementById('memberYouArePayingFor').style.display="block";

            }else{
              document.getElementById('memberYouArePayingFor').style.display="none";

            }
            if(sel3 === 'non_member' && sel === 'loans' && selvalue === 'others'){
              document.getElementById('nonMemberSelection').style.display="block";
              document.getElementById('memberYouArePayingFor').style.display="none";
            }else if(sel3 === 'member' && sel === 'loans' && selvalue === 'others'){
              document.getElementById('memberYouArePayingFor').style.display="block";
              document.getElementById('nonMemberSelection').style.display="none";

            }
          }
          
     
          </script>
       
</div>
</div>