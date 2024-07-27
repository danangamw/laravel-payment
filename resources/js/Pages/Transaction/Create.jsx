import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import SelectInput from "@/Components/SelectInput";
import TextInput from "@/Components/TextInput";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Create({ auth }) {
    const { data, setData, post, errors, reset } = useForm({
        amount: 0,
        type: "",
    });

    const onSubmit = (e) => {
        e.preventDefault();

        // console.log(data);
        post(route("transaction.store"));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <div className="flex justify-between items-center">
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Create new Transaction
                    </h2>
                </div>
            }
        >
            <Head title="Projects" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <form
                            onSubmit={onSubmit}
                            className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                        >
                            <div className="mt-4">
                                <InputLabel
                                    htmlFor="transaction_amount"
                                    value="Transaction Amount"
                                />

                                <TextInput
                                    id="transaction_amount"
                                    type="number"
                                    name="amount"
                                    value={data.amount}
                                    className="mt-1 block w-full"
                                    isFocused={true}
                                    onChange={(e) =>
                                        setData("amount", e.target.value)
                                    }
                                />

                                <InputError
                                    message={errors.amount}
                                    className="mt-2"
                                />
                            </div>
                            <div className="mt-4">
                                <InputLabel
                                    htmlFor="transaction_type"
                                    value="Transaction Type"
                                />

                                <SelectInput
                                    name="type"
                                    id="transaction_type"
                                    className="mt-1 block w-full"
                                    onChange={(e) =>
                                        setData("type", e.target.value)
                                    }
                                >
                                    <option value="">
                                        Select Transaction Type
                                    </option>
                                    <option value="deposit">Deposit</option>
                                    <option value="withdraw">Withdraw</option>
                                </SelectInput>

                                <InputError
                                    message={errors.type}
                                    className="mt-2"
                                />
                            </div>

                            <div className="mt-4 text-right">
                                <Link
                                    href={route("transaction.index")}
                                    className="bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all hover:bg-gray-200 mr-2"
                                >
                                    Cancel
                                </Link>
                                <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
