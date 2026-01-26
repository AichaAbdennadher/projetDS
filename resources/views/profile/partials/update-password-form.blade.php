<section>
    
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="update_password_current_password">
                Current Password
            </label>
            <input type="password" name="current_password" id="update_password_current_password" autocomplete="current-password"
                   class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
            @if($errors->updatePassword->get('current_password'))
                <p class="text-red-500 text-xs italic mt-2">{{ $errors->updatePassword->get('current_password')[0] }}</p>
            @endif
        </div>

        <!-- New Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="update_password_password">
                New Password
            </label>
            <input type="password" name="password" id="update_password_password" autocomplete="new-password"
                   class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
             @if($errors->updatePassword->get('password'))
                <p class="text-red-500 text-xs italic mt-2">{{ $errors->updatePassword->get('password')[0] }}</p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="update_password_password_confirmation">
                Confirm Password
            </label>
            <input type="password" name="password_confirmation" id="update_password_password_confirmation" autocomplete="new-password"
                   class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
            @if($errors->updatePassword->get('password_confirmation'))
                <p class="text-red-500 text-xs italic mt-2">{{ $errors->updatePassword->get('password_confirmation')[0] }}</p>
            @endif
        </div>

        <!-- Buttons Grid -->
        <div class="grid grid-cols-2 gap-4 mt-8">
            <button type="button" @click="$dispatch('close-modal', 'update-password')"
                    class="flex items-center justify-center w-full h-12 rounded-lg border border-[#7a49f5] text-[#7a49f5] font-semibold hover:bg-purple-50 transition">
                Cancel
            </button>
            <button type="submit"
                    class="flex items-center justify-center w-full h-12 rounded-lg bg-[#7a49f5] text-white font-semibold hover:bg-[#693de0] transition shadow-md hover:shadow-lg">
                Update
            </button>
        </div>
    </form>
</section>
