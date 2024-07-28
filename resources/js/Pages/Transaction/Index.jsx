import Pagination from "@/Components/Pagination";
import {
    TRANSACTION_STATUS_CLASS_MAP,
    TRANSACTION_STATUS_TEXT_MAP,
} from "@/constants";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Dashboard({ auth, transactions, wallet, success }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <div className="flex justify-between items-center">
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Transactions
                    </h2>
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Your Balance: {wallet.balance}
                    </h2>
                    <Link
                        href={route("transaction.create")}
                        className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
                    >
                        Deposit/Withdraw
                    </Link>
                </div>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {success && (
                        <div className="bg-emerald-500 py-2 px-4 text-white rounded mb-4">
                            {success}
                        </div>
                    )}

                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        {transactions.data.length === 0 ? (
                            <p className="p-4 text-center text-gray-500 dark:text-gray-400">
                                You don't make any transaction yet...
                            </p>
                        ) : (
                            <div className="p-6 text-gray-900 dark:text-gray-100">
                                <table className="w-full text-sm text-left rtl-text-right text-gray-500 dark:text-gray-400">
                                    <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-500">
                                        <tr className="text-nowrap">
                                            <th className="px-3 py-2">ID</th>
                                            <th className="px-3 py-2">
                                                Amount
                                            </th>
                                            <th className="px-3 py-2">
                                                Status
                                            </th>
                                            <th className="px-3 py-2">
                                                Transaction Type
                                            </th>
                                            <th className="px-3 py-2">
                                                Transaction By
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {transactions.data.map(
                                            (transaction) => (
                                                <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <td className="px-3 py-2">
                                                        {transaction.id}
                                                    </td>
                                                    <td className="px-3 py-2">
                                                        {transaction.amount}
                                                    </td>
                                                    <td className="px-3 py-2">
                                                        <span
                                                            className={
                                                                "px-2 py-1 rounded text-white " +
                                                                TRANSACTION_STATUS_CLASS_MAP[
                                                                    transaction
                                                                        .status
                                                                ]
                                                            }
                                                        >
                                                            {
                                                                TRANSACTION_STATUS_TEXT_MAP[
                                                                    transaction
                                                                        .status
                                                                ]
                                                            }
                                                        </span>
                                                    </td>
                                                    <td className="px-3 py-2">
                                                        {transaction.type}
                                                    </td>
                                                    <td className="px-3 py-2">
                                                        {transaction.user
                                                            ? transaction.user
                                                                  .name
                                                            : "You"}
                                                    </td>
                                                </tr>
                                            )
                                        )}
                                    </tbody>
                                </table>
                                <Pagination links={transactions.meta.links} />
                            </div>
                        )}

                        {/* <pre>{JSON.stringify(transactions, undefined, 2)}</pre> */}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
