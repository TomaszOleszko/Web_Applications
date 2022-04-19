import {FiX} from "react-icons/fi"
import {useState} from "react";
import {GiMilkCarton, GiSlicedBread, GiShinyApple} from 'react-icons/gi'

const Product = ({product, onDelete}) => {
    const [isChecked, setIsChecked] = useState(false)
    return (
        <div className='product'>
            {product.category === "diary" && <GiMilkCarton style={{color: "whitesmoke"}} className='category'/>}
            {product.category === "bread" && <GiSlicedBread style={{color: "wheat"}} className='category'/>}
            {product.category === "fruits&vagetables" &&
            <GiShinyApple style={{color: "orangered"}} className='category'/>}
            <div className='product-info'>
                <div className='input-name'>
                    <input type='checkbox' value={isChecked}
                           onChange={() => setIsChecked(!isChecked)}
                           required/>
                    <p className={
                        isChecked ? 'checked' : ''}>{product.name}</p>
                </div>
                <p>{product.quantity}</p>
            </div>
            <div className='product-icons'>
                <FiX onClick={() => onDelete(product.id)}/>
            </div>
        </div>
    )
}
export default Product
