<template>
    <Head title="Tổng quan" />

    <div class="max-w-screen-2xl mx-auto my-8 w-full space-y-6">
        <!-- Bộ lọc thời gian -->
        <div class="bg-white rounded-md shadow-md p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-700">Bộ lọc báo cáo</h2>
                <div class="flex gap-2">
                    <button
                        v-for="period in timePeriods"
                        :key="period.value"
                        @click="selectedPeriod = period.value"
                        :class="[
                            'px-4 py-2 rounded-md text-sm font-medium transition-colors',
                            selectedPeriod === period.value
                                ? 'bg-blue-500 text-white'
                                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                        ]"
                    >
                        {{ period.label }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Thống kê tổng quan -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Đơn hàng -->
            <div class="bg-white rounded-md shadow-xl overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600 mb-1">Đơn hàng</p>
                            <p class="text-3xl font-bold text-green-500">{{ stats.orders }}</p>
                            <p v-if="stats.ordersChange !== undefined" class="text-sm mt-2" :class="stats.ordersChange > 0 ? 'text-green-600' : stats.ordersChange < 0 ? 'text-red-600' : 'text-gray-600'">
                                <span v-if="stats.ordersChange > 0">↑</span>
                                <span v-else-if="stats.ordersChange < 0">↓</span>
                                <span v-else>→</span>
                                {{ Math.abs(stats.ordersChange) }}%
                            </p>
                        </div>
                        <div class="p-3 rounded-lg bg-green-100">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" class="text-green-500">
                                <circle cx="20" cy="20" r="20" fill="currentColor"/>
                                <path d="M9.58337 10.625H30.4167V14.7917H9.58337V10.625ZM27.2917 15.8333H10.625V27.2917C10.625 27.8442 10.8445 28.3741 11.2352 28.7648C11.6259 29.1555 12.1558 29.375 12.7084 29.375H27.2917C27.8442 29.375 28.3741 29.1555 28.7648 28.7648C29.1555 28.3741 29.375 27.8442 29.375 27.2917V15.8333H27.2917ZM24.1667 22.0833H15.8334V20H24.1667V22.0833Z" fill="white"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Doanh thu -->
            <div class="bg-white rounded-md shadow-xl overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600 mb-1">Doanh thu</p>
                            <p class="text-3xl font-bold text-blue-500">{{ formatCurrency(stats.revenue) }}</p>
                            <p v-if="stats.revenueChange !== undefined" class="text-sm mt-2" :class="stats.revenueChange > 0 ? 'text-green-600' : stats.revenueChange < 0 ? 'text-red-600' : 'text-gray-600'">
                                <span v-if="stats.revenueChange > 0">↑</span>
                                <span v-else-if="stats.revenueChange < 0">↓</span>
                                <span v-else>→</span>
                                {{ Math.abs(stats.revenueChange) }}%
                            </p>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-100">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" class="text-blue-500">
                                <circle cx="20" cy="20" r="20" fill="currentColor"/>
                                <path d="M24.0082 15.1914H15.9919C15.9919 15.1914 10.3801 20.0003 10.3801 25.6122C10.3801 28.8174 12.7933 30.4211 14.3882 30.4211H25.6119C27.2134 30.4211 29.6201 28.8174 29.6201 25.6122C29.6201 20.0003 24.0082 15.1914 24.0082 15.1914ZM20.8008 26.3317V27.6151H19.1993V26.3361C18.019 26.1167 17.2775 25.3884 17.2249 24.3309H18.6136C18.6816 24.886 19.241 25.2436 20.0505 25.2436C20.7964 25.2436 21.3251 24.8816 21.3251 24.3661C21.3251 23.9273 20.9829 23.6772 20.1405 23.4885L19.2476 23.2976C17.9971 23.0366 17.3828 22.385 17.3828 21.3385C17.3828 20.2921 18.0805 19.5374 19.1905 19.2895V17.9973H20.792V19.2917C21.8758 19.533 22.5976 20.2723 22.6327 21.2662H21.2922C21.2242 20.7243 20.7196 20.3623 20.0264 20.3623C19.3331 20.3623 18.8329 20.6958 18.8329 21.2179C18.8329 21.6413 19.1598 21.876 19.965 22.0559L20.792 22.2314C22.172 22.521 22.7665 23.109 22.7665 24.1818C22.7665 25.3291 22.0294 26.097 20.8008 26.3317Z" fill="white"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Liên hệ -->
            <div class="bg-white rounded-md shadow-xl overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600 mb-1">Liên hệ</p>
                            <p class="text-3xl font-bold text-pink-500">{{ stats.contacts }}</p>
                            <p v-if="stats.contactsChange !== undefined" class="text-sm mt-2" :class="stats.contactsChange > 0 ? 'text-green-600' : stats.contactsChange < 0 ? 'text-red-600' : 'text-gray-600'">
                                <span v-if="stats.contactsChange > 0">↑</span>
                                <span v-else-if="stats.contactsChange < 0">↓</span>
                                <span v-else>→</span>
                                {{ Math.abs(stats.contactsChange) }}%
                            </p>
                        </div>
                        <div class="p-3 rounded-lg bg-pink-100">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" class="text-pink-500">
                                <circle cx="20" cy="20" r="20" fill="currentColor"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.4578 20.547C24.0767 25.1646 25.1246 19.8225 28.0655 22.7614C30.9007 25.5958 32.5303 26.1637 28.9381 29.7549C28.4881 30.1166 25.6292 34.467 15.5822 24.4228C5.53387 14.3773 9.88183 11.5155 10.2435 11.0656C13.8445 7.46445 14.4026 9.1035 17.2378 11.938C20.1787 14.878 14.8389 15.9293 19.4578 20.547Z" fill="white"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Đơn ứng tuyển -->
            <div class="bg-white rounded-md shadow-xl overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600 mb-1">Đơn ứng tuyển</p>
                            <p class="text-3xl font-bold text-yellow-500">{{ stats.applies }}</p>
                            <p v-if="stats.appliesChange !== undefined" class="text-sm mt-2" :class="stats.appliesChange > 0 ? 'text-green-600' : stats.appliesChange < 0 ? 'text-red-600' : 'text-gray-600'">
                                <span v-if="stats.appliesChange > 0">↑</span>
                                <span v-else-if="stats.appliesChange < 0">↓</span>
                                <span v-else>→</span>
                                {{ Math.abs(stats.appliesChange) }}%
                            </p>
                        </div>
                        <div class="p-3 rounded-lg bg-yellow-100">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" class="text-yellow-500">
                                <circle cx="20" cy="20" r="20" fill="currentColor"/>
                                <path d="M19.3749 22.7812C20.3783 22.1147 21.1405 21.1428 21.5486 20.0094C21.9568 18.876 21.9892 17.6414 21.6411 16.4881C21.293 15.3349 20.5828 14.3244 19.6157 13.6061C18.6486 12.8878 17.476 12.5 16.2714 12.5C15.0667 12.5 13.8941 12.8878 12.927 13.6061C11.9599 14.3244 11.2498 15.3349 10.9016 16.4881C10.5535 17.6414 10.5859 18.876 10.9941 20.0094C11.4022 21.1428 12.1644 22.1147 13.1678 22.7812C11.4573 23.4122 9.97887 24.5482 8.92858 26.0385C8.84972 26.1506 8.80315 26.2821 8.79393 26.4187C8.78471 26.5554 8.81321 26.692 8.87631 26.8136C8.93941 26.9352 9.03469 27.0371 9.15175 27.1082C9.26882 27.1793 9.40317 27.217 9.54015 27.2169L23.0023 27.2164C23.1392 27.2164 23.2736 27.1788 23.3906 27.1077C23.5077 27.0365 23.603 26.9346 23.6661 26.813C23.7291 26.6914 23.7576 26.5548 23.7484 26.4182C23.7392 26.2815 23.6926 26.15 23.6137 26.038C22.5634 24.5479 21.0852 23.4122 19.3749 22.7812Z" fill="white"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê chi tiết -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Báo cáo đơn hàng -->
            <div class="bg-white rounded-md shadow-xl">
                <div class="p-4 border-b">
                    <h3 class="text-lg font-bold text-gray-700">Báo cáo đơn hàng</h3>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        <div
                            v-for="status in orderStatuses"
                            :key="status.key"
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-md"
                        >
                            <div class="flex items-center space-x-3">
                                <div
                                    :class="[
                                        'w-3 h-3 rounded-full',
                                        status.color
                                    ]"
                                ></div>
                                <span class="font-medium text-gray-700">{{ status.label }}</span>
                            </div>
                            <span class="text-lg font-semibold text-gray-900">
                                {{ orderStats[status.key] || 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Báo cáo liên hệ -->
            <div class="bg-white rounded-md shadow-xl">
                <div class="p-4 border-b">
                    <h3 class="text-lg font-bold text-gray-700">Báo cáo liên hệ</h3>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        <div
                            v-for="status in contactStatuses"
                            :key="status.key"
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-md"
                        >
                            <div class="flex items-center space-x-3">
                                <div
                                    :class="[
                                        'w-3 h-3 rounded-full',
                                        status.color
                                    ]"
                                ></div>
                                <span class="font-medium text-gray-700">{{ status.label }}</span>
                            </div>
                            <span class="text-lg font-semibold text-gray-900">
                                {{ contactStats[status.key] || 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bảng báo cáo chi tiết -->
        <div class="bg-white rounded-md shadow-xl">
            <div class="p-4 border-b">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-700">Báo cáo chi tiết</h3>
                    <div class="flex gap-2">
                        <button
                            @click="exportReport('excel')"
                            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors text-sm font-medium flex items-center gap-2"
                        >
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M2 2H14V14H2V2ZM3 3V13H13V3H3ZM4 4H12V5H4V4ZM4 6H12V7H4V6ZM4 8H12V9H4V8ZM4 10H9V11H4V10Z" fill="currentColor"/>
                            </svg>
                            Xuất Excel
                        </button>
                        <button
                            @click="exportReport('pdf')"
                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors text-sm font-medium flex items-center gap-2"
                        >
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M3 2H13V14H3V2ZM4 3V13H12V3H4ZM5 4H11V5H5V4ZM5 6H11V7H5V6ZM5 8H11V9H5V8ZM5 10H8V11H5V10Z" fill="currentColor"/>
                            </svg>
                            Xuất PDF
                        </button>
                        <button
                            @click="refreshData"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors text-sm font-medium flex items-center gap-2"
                        >
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M8 2V6H12M8 14V10H4M2 8H6M10 8H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            Làm mới
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-3 font-semibold text-gray-700">Chỉ số</th>
                            <th class="text-right p-3 font-semibold text-gray-700">Hôm nay</th>
                            <th class="text-right p-3 font-semibold text-gray-700">Tuần này</th>
                            <th class="text-right p-3 font-semibold text-gray-700">Tháng này</th>
                            <th class="text-right p-3 font-semibold text-gray-700">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="metric in detailedMetrics" :key="metric.key" class="border-b hover:bg-gray-50">
                            <td class="p-3 font-medium text-gray-700">{{ metric.label }}</td>
                            <td class="p-3 text-right text-gray-900">{{ formatMetric(metric.key, 'today') }}</td>
                            <td class="p-3 text-right text-gray-900">{{ formatMetric(metric.key, 'week') }}</td>
                            <td class="p-3 text-right text-gray-900">{{ formatMetric(metric.key, 'month') }}</td>
                            <td class="p-3 text-right font-semibold text-gray-900">{{ formatMetric(metric.key, 'total') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Thông số hệ thống -->
        <div class="bg-white rounded-md shadow-xl">
            <div class="p-4 border-b">
                <h3 class="text-lg font-bold text-gray-700">Thông số hệ thống</h3>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Đơn hàng mới</p>
                                <p class="text-2xl font-bold text-blue-600 mt-1">
                                    {{ $page.props.data.new_order_count || 0 }}
                                </p>
                            </div>
                            <div class="text-blue-500">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <circle cx="20" cy="20" r="20" fill="currentColor" opacity="0.2" />
                                    <path
                                        d="M24.0082 15.1914H15.9919C15.9919 15.1914 10.3801 20.0003 10.3801 25.6122C10.3801 28.8174 12.7933 30.4211 14.3882 30.4211H25.6119C27.2134 30.4211 29.6201 28.8174 29.6201 25.6122C29.6201 20.0003 24.0082 15.1914 24.0082 15.1914Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-pink-50 to-pink-100 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Liên hệ mới</p>
                                <p class="text-2xl font-bold text-pink-600 mt-1">
                                    {{ $page.props.data.new_contact_count || 0 }}
                                </p>
                            </div>
                            <div class="text-pink-500">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <circle cx="20" cy="20" r="20" fill="currentColor" opacity="0.2" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M19.4578 20.547C24.0767 25.1646 25.1246 19.8225 28.0655 22.7614C30.9007 25.5958 32.5303 26.1637 28.9381 29.7549C28.4881 30.1166 25.6292 34.467 15.5822 24.4228C5.53387 14.3773 9.88183 11.5155 10.2435 11.0656C13.8445 7.46445 14.4026 9.1035 17.2378 11.938C20.1787 14.878 14.8389 15.9293 19.4578 20.547Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Đơn ứng tuyển mới</p>
                                <p class="text-2xl font-bold text-yellow-600 mt-1">
                                    {{ $page.props.data.new_apply_count || 0 }}
                                </p>
                            </div>
                            <div class="text-yellow-500">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <circle cx="20" cy="20" r="20" fill="currentColor" opacity="0.2" />
                                    <path
                                        d="M19.3749 22.7812C20.3783 22.1147 21.1405 21.1428 21.5486 20.0094C21.9568 18.876 21.9892 17.6414 21.6411 16.4881C21.293 15.3349 20.5828 14.3244 19.6157 13.6061C18.6486 12.8878 17.476 12.5 16.2714 12.5C15.0667 12.5 13.8941 12.8878 12.927 13.6061C11.9599 14.3244 11.2498 15.3349 10.9016 16.4881C10.5535 17.6414 10.5859 18.876 10.9941 20.0094C11.4022 21.1428 12.1644 22.1147 13.1678 22.7812C11.4573 23.4122 9.97887 24.5482 8.92858 26.0385C8.84972 26.1506 8.80315 26.2821 8.79393 26.4187C8.78471 26.5554 8.81321 26.692 8.87631 26.8136C8.93941 26.9352 9.03469 27.0371 9.15175 27.1082C9.26882 27.1793 9.40317 27.217 9.54015 27.2169L23.0023 27.2164C23.1392 27.2164 23.2736 27.1788 23.3906 27.1077C23.5077 27.0365 23.603 26.9346 23.6661 26.813C23.7291 26.6914 23.7576 26.5548 23.7484 26.4182C23.7392 26.2815 23.6926 26.15 23.6137 26.038C22.5634 24.5479 21.0852 23.4122 19.3749 22.7812Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Head,
    },
    data() {
        return {
            selectedPeriod: 'today',
            timePeriods: [
                { label: 'Hôm nay', value: 'today' },
                { label: 'Tuần này', value: 'week' },
                { label: 'Tháng này', value: 'month' },
                { label: 'Tất cả', value: 'all' },
            ],
            orderStatuses: [
                { key: 'new', label: 'Mới', color: 'bg-yellow-500' },
                { key: 'verified', label: 'Đã xác nhận', color: 'bg-blue-500' },
                { key: 'processing', label: 'Đang xử lý', color: 'bg-purple-500' },
                { key: 'delivering', label: 'Đang giao hàng', color: 'bg-indigo-500' },
                { key: 'completed', label: 'Hoàn thành', color: 'bg-green-500' },
                { key: 'cancelled', label: 'Đã hủy', color: 'bg-red-500' },
            ],
            contactStatuses: [
                { key: 'new', label: 'Mới', color: 'bg-yellow-500' },
                { key: 'response', label: 'Đã phản hồi', color: 'bg-blue-500' },
                { key: 'processed', label: 'Đã xử lý', color: 'bg-green-500' },
                { key: 'close', label: 'Đóng', color: 'bg-gray-500' },
                { key: 'is_spam', label: 'Spam', color: 'bg-red-500' },
            ],
            detailedMetrics: [
                { key: 'orders', label: 'Tổng đơn hàng' },
                { key: 'revenue', label: 'Tổng doanh thu' },
                { key: 'contacts', label: 'Tổng liên hệ' },
                { key: 'applies', label: 'Tổng đơn ứng tuyển' },
            ],
            orderStats: {},
            contactStats: {},
        }
    },
    computed: {
        stats() {
            const data = this.$page.props.data || {}
            const period = this.selectedPeriod

            // Tính toán thống kê dựa trên period
            let orders = 0
            let revenue = 0
            let contacts = 0
            let applies = 0

            if (period === 'today') {
                orders = data.today_order_count || 0
                revenue = data.today_order_total_price || 0
                contacts = data.today_contact_count || 0
                applies = data.today_apply_count || 0
            } else {
                // Mặc định hiển thị hôm nay nếu chưa có dữ liệu cho các period khác
                orders = data.today_order_count || 0
                revenue = data.today_order_total_price || 0
                contacts = data.today_contact_count || 0
                applies = data.today_apply_count || 0
            }

            return {
                orders,
                revenue,
                contacts,
                applies,
                ordersChange: 0, // Có thể tính toán từ dữ liệu so sánh
                revenueChange: 0,
                contactsChange: 0,
                appliesChange: 0,
            }
        },
    },
    mounted() {
        this.loadStats()
        this.appendAnalyticsScript()
    },
    methods: {
        formatCurrency(value) {
            if (!value) return '0 ₫'
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            }).format(value)
        },
        formatMetric(key, period) {
            const data = this.$page.props.data || {}
            
            if (key === 'revenue') {
                if (period === 'today') return this.formatCurrency(data.today_order_total_price || 0)
                return this.formatCurrency(0) // Cần thêm dữ liệu từ backend
            }
            
            if (period === 'today') {
                switch (key) {
                    case 'orders':
                        return data.today_order_count || 0
                    case 'contacts':
                        return data.today_contact_count || 0
                    case 'applies':
                        return data.today_apply_count || 0
                }
            }
            
            return 0 // Cần thêm dữ liệu từ backend cho các period khác
        },
        loadStats() {
            // Load thống kê chi tiết từ backend
            // Có thể gọi API để lấy dữ liệu orderStats và contactStats
            this.orderStats = {
                new: this.$page.props.data.new_order_count || 0,
                verified: 0,
                processing: 0,
                delivering: 0,
                completed: 0,
                cancelled: 0,
            }
            
            this.contactStats = {
                new: this.$page.props.data.new_contact_count || 0,
                response: 0,
                processed: 0,
                close: 0,
                is_spam: 0,
            }
        },
        refreshData() {
            this.$inertia.reload()
        },
        exportReport(format) {
            // Tạo dữ liệu báo cáo
            const reportData = {
                period: this.selectedPeriod,
                stats: this.stats,
                orderStats: this.orderStats,
                contactStats: this.contactStats,
                detailedMetrics: this.detailedMetrics.map(metric => ({
                    label: metric.label,
                    today: this.formatMetric(metric.key, 'today'),
                    week: this.formatMetric(metric.key, 'week'),
                    month: this.formatMetric(metric.key, 'month'),
                    total: this.formatMetric(metric.key, 'total'),
                })),
                generatedAt: new Date().toLocaleString('vi-VN'),
            }

            if (format === 'excel') {
                // Xuất Excel - có thể gọi API hoặc tạo file client-side
                this.downloadExcel(reportData)
            } else if (format === 'pdf') {
                // Xuất PDF - có thể gọi API hoặc sử dụng thư viện client-side
                this.downloadPDF(reportData)
            }
        },
        downloadExcel(data) {
            // Tạo CSV content (có thể mở rộng thành Excel thực sự)
            let csvContent = 'BÁO CÁO TỔNG QUAN\n\n'
            csvContent += `Kỳ báo cáo: ${this.timePeriods.find(p => p.value === data.period)?.label || 'N/A'}\n`
            csvContent += `Thời gian tạo: ${data.generatedAt}\n\n`
            
            csvContent += 'THỐNG KÊ TỔNG QUAN\n'
            csvContent += `Đơn hàng,${data.stats.orders}\n`
            csvContent += `Doanh thu,${data.stats.revenue}\n`
            csvContent += `Liên hệ,${data.stats.contacts}\n`
            csvContent += `Đơn ứng tuyển,${data.stats.applies}\n\n`
            
            csvContent += 'BÁO CÁO CHI TIẾT\n'
            csvContent += 'Chỉ số,Hôm nay,Tuần này,Tháng này,Tổng\n'
            data.detailedMetrics.forEach(metric => {
                csvContent += `${metric.label},${metric.today},${metric.week},${metric.month},${metric.total}\n`
            })

            // Tạo và tải file
            const blob = new Blob(['\ufeff' + csvContent], { type: 'text/csv;charset=utf-8;' })
            const link = document.createElement('a')
            const url = URL.createObjectURL(blob)
            link.setAttribute('href', url)
            link.setAttribute('download', `bao-cao-${data.period}-${new Date().toISOString().split('T')[0]}.csv`)
            link.style.visibility = 'hidden'
            document.body.appendChild(link)
            link.click()
            document.body.removeChild(link)
        },
        downloadPDF(data) {
            // Tạo nội dung HTML cho PDF
            let htmlContent = `
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Báo cáo tổng quan</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        h1 { color: #333; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    <h1>BÁO CÁO TỔNG QUAN</h1>
                    <p><strong>Kỳ báo cáo:</strong> ${this.timePeriods.find(p => p.value === data.period)?.label || 'N/A'}</p>
                    <p><strong>Thời gian tạo:</strong> ${data.generatedAt}</p>
                    
                    <h2>Thống kê tổng quan</h2>
                    <ul>
                        <li>Đơn hàng: ${data.stats.orders}</li>
                        <li>Doanh thu: ${this.formatCurrency(data.stats.revenue)}</li>
                        <li>Liên hệ: ${data.stats.contacts}</li>
                        <li>Đơn ứng tuyển: ${data.stats.applies}</li>
                    </ul>
                    
                    <h2>Báo cáo chi tiết</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Chỉ số</th>
                                <th>Hôm nay</th>
                                <th>Tuần này</th>
                                <th>Tháng này</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${data.detailedMetrics.map(metric => `
                                <tr>
                                    <td>${metric.label}</td>
                                    <td>${metric.today}</td>
                                    <td>${metric.week}</td>
                                    <td>${metric.month}</td>
                                    <td>${metric.total}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </body>
                </html>
            `

            // Mở cửa sổ mới để in (có thể chuyển thành PDF)
            const printWindow = window.open('', '_blank')
            printWindow.document.write(htmlContent)
            printWindow.document.close()
            printWindow.print()
        },
        appendAnalyticsScript() {
            // Kiểm tra xem script đã được thêm chưa
            if (document.querySelector('script[src*="analytics.jamstackvietnam.com"]')) {
                return
            }
            
            const script = document.createElement('script')
            script.setAttribute('src', 'https://analytics.jamstackvietnam.com/js/embed.host.js')
            script.async = true
            document.head.appendChild(script)
        },
    },
}
</script>

<style scoped>
.p-component-overlay-enter {
    animation: none !important;
}

/* Animation cho các thẻ thống kê */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.bg-white {
    animation: fadeIn 0.3s ease-out;
}
</style>